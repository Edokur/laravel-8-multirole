<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Collection;

class PeminjamanPimpinanController extends Controller
{
    public function index(Request $request)
    {
        $peminjaman = DB::table('peminjaman as p')
            ->select('p.id', 'p.kode_pinjam', 'u.name', 'p.tgl_pinjam', 'p.tgl_kembali', 'p.keterangan_proses', 'p.keterangan_peminjaman')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->where('status', 'Diterima')
            ->get();
        if ($request->ajax()) {
            $allData = DataTables::of($peminjaman)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="/peminjaman_pimpinan/detail_pimpinan/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailPengguna"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }

        return view('peminjaman.pimpinan.index_pimpinan', compact('peminjaman'), [
            'title' => 'Data Peminjaman'
        ]);
    }

    public function detail($id)
    {
        $peminjaman = DB::table('peminjaman as p')
            ->select('p.id', 'p.barang_id', 'p.jumlah_pinjaman', 'p.kode_pinjam', 'p.tgl_pinjam', 'p.tgl_kembali', 'p.keterangan_peminjaman', 'u.name', 'p.keterangan_proses')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->where('p.id', $id)
            ->get();

        $barang = json_decode($peminjaman[0]->barang_id);
        $jumlah_pinjaman = json_decode($peminjaman[0]->jumlah_pinjaman);
        $data_barang = [];
        $data_pinjam = [];

        for ($i = 0; $i < count($barang); $i++) {
            $cek_barang = DB::table('barang_detail as bd')
                ->select('bd.id', 'bd.kode_barang', 'b.nama_barang', 'bd.kondisi_barang', 'bd.spesifikasi')
                ->leftJoin('barang as b', 'bd.barang_id', '=', 'b.id')
                ->where('bd.id', $barang[$i])
                ->get();
            $data_barang[] = $cek_barang;
        };

        for ($j = 0; $j < count($jumlah_pinjaman); $j++) {
            $data_pinjam[] = new Collection($jumlah_pinjaman[$j]);
        }

        return view('peminjaman.pimpinan.detail_pimpinan', [
            'title' => 'Data Peminjaman',
            'peminjaman' => $peminjaman,
            'barang' => $data_barang,
            'pinjaman' => $data_pinjam
        ])->with('no');
    }

    public function halpdf_pimpinan()
    {
        $barang = DB::table('barang_detail as bd')
            ->select('*')
            ->leftJoin('barang as b', 'bd.barang_id', '=', 'b.id')
            ->get();

        return view('peminjaman.pimpinan.halpdf_pimpinan', compact('barang'), [
            'title' => 'Data Peminjaman'
        ]);
    }

    public static function PeminjamancetakPDF_pimpinan(Request $request)
    {
        $peminjaman = DB::table('peminjaman as p')
            ->select('p.id', 'p.barang_id', 'p.jumlah_pinjaman', 'p.kode_pinjam', 'p.tgl_pinjam', 'p.tgl_kembali', 'p.keterangan_peminjaman', 'u.name')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->get();

        $barang = json_decode($peminjaman[0]->barang_id);
        $jumlah_pinjaman = json_decode($peminjaman[0]->jumlah_pinjaman);
        $data_barang = [];
        $data_pinjam = [];

        for ($i = 0; $i < count($barang); $i++) {
            $cek_barang = DB::table('barang_detail as bd')
                ->select('bd.id', 'bd.kode_barang', 'b.nama_barang', 'bd.kondisi_barang', 'bd.spesifikasi')
                ->leftJoin('barang as b', 'bd.barang_id', '=', 'b.id')
                ->where('bd.id', $barang[$i])
                ->get();
            $data_barang[] = $cek_barang;
        };

        for ($j = 0; $j < count($jumlah_pinjaman); $j++) {
            $data_pinjam[] = new Collection($jumlah_pinjaman[$j]);
        }

        $mytime = Carbon::now();
        if ($peminjaman->isNotEmpty()) {
            $pdf = App::make('dompdf.wrapper');
            $pdf->setPaper('a4', 'landscape');
            $pdf->loadView('peminjaman.pimpinan.cetak_peminjaman_pimpinan', ['peminjaman' => $peminjaman, 'barang' => $data_barang, 'pinjaman' => $data_pinjam]);
            return $pdf->download('Laporan-Peminjaman-Pimpinan' . ($mytime->toDateString()) . '.pdf');
        } else {
            $response['success'] = false;
            $response['message'] = 'Tidak Memiliki Data Peminjaman Dalam Jangka Waktu Tersebut';
        }
        return $response;
    }
}
