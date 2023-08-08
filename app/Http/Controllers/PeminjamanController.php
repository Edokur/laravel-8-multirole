<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Keranjang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Collection;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('peminjaman.admin.index', [
            'title' => 'Data Peminjaman'
        ]);
    }

    public function terpinjam_table(Request $request)
    {
        $peminjaman = DB::table('peminjaman as p')
            ->select('p.id', 'p.kode_pinjam', 'u.name', 'p.tgl_pinjam', 'p.tgl_kembali', 'p.keterangan_proses', 'p.keterangan_peminjaman')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->where('status', 'Dipinjam')
            ->get();
        if ($request->ajax()) {
            $allData = DataTables::of($peminjaman)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/peminjaman/detail_pengembalian/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailPengguna"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }
    }

    public function selesai_table(Request $request)
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
                    <a href="/peminjaman/index_detail/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailPengguna"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }
    }

    public function pengajuan_table(Request $request)
    {
        $peminjaman = DB::table('peminjaman as p')
            ->select('p.id', 'p.kode_pinjam', 'u.name', 'p.tgl_pinjam', 'p.tgl_kembali', 'p.keterangan_proses', 'p.keterangan_peminjaman')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->where('status', 'Diproses')
            ->get();

        if ($request->ajax()) {
            $allData = DataTables::of($peminjaman)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/peminjaman/detail/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailPengguna"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }
    }

    public function dibatalkan_table(Request $request)
    {
        $peminjaman = DB::table('peminjaman as p')
            ->select('p.id', 'p.kode_pinjam', 'u.name', 'p.tgl_pinjam', 'p.tgl_kembali', 'p.keterangan_proses', 'p.keterangan_peminjaman')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->where('status', 'Ditolak')
            ->get();
        if ($request->ajax()) {
            $allData = DataTables::of($peminjaman)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="/peminjaman/index_detail/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailPengguna"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }
    }

    public function index_detail($id)
    {
        $peminjaman = DB::table('peminjaman as p')
            ->select('p.id', 'p.barang_id', 'p.jumlah_pinjaman', 'p.kode_pinjam', 'p.tgl_pinjam', 'p.tgl_kembali', 'p.keterangan_peminjaman', 'u.name')
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

        return view('peminjaman.admin.index_detail', [
            'title' => 'Data Peminjaman',
            'peminjaman' => $peminjaman,
            'barang' => $data_barang,
            'pinjaman' => $data_pinjam
        ])->with('no');
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

        return view('peminjaman.admin.detail', [
            'title' => 'Data Peminjaman',
            'peminjaman' => $peminjaman,
            'barang' => $data_barang,
            'pinjaman' => $data_pinjam
        ])->with('no');
    }

    public function terimaPeminjaman(Request $request)
    {
        $kode_pinjam = $request->kode_pinjam;
        $id_pinjam = $request->id_pinjam;

        $peminjaman = DB::table('peminjaman')->where('id', $id_pinjam)->where('kode_pinjam', $kode_pinjam)->get();

        $data_barang_id = json_decode($peminjaman[0]->barang_id);
        $data_jumlah_pinjaman = json_decode($peminjaman[0]->jumlah_pinjaman);

        for ($i = 0; $i < count($data_barang_id); $i++) {
            $barang_id = $data_barang_id[$i];
            $jumlah_pinjam = $data_jumlah_pinjaman[$i];
            $stokBarang = DB::table('barang_detail')->where('id', $barang_id)->first();
            if ($stokBarang->stok_barang > $jumlah_pinjam) {
                $descade = DB::table('barang_detail')->where('id', $barang_id)->update(['stok_barang' => $stokBarang->stok_barang - $jumlah_pinjam]);
                $output = DB::table('peminjaman')->where('kode_pinjam', $kode_pinjam)->where('id', $id_pinjam)->update(['status' => 'Dipinjam']);

                $response['success'] = true;
                $response['message'] = 'Anda Berhasil Menyetujui Peminjaman Barang dengan Kode Pinjaman ' . $kode_pinjam . '';
            } else {
                $response['success'] = false;
                $response['message'] = 'Stok Barang Tidak Mencukupi Untuk Menerima Peminjaman Barang dengan Kode Pinjaman ' . $kode_pinjam . '';

                return $response;
            }
        }

        return $response;
    }

    public function tolakPeminjaman(Request $request)
    {
        $kode_pinjam = $request->kode_pinjam;
        $id_pinjam = $request->id_pinjam;
        $output = DB::table('peminjaman')
            ->where('kode_pinjam', $kode_pinjam)
            ->where('id', $id_pinjam)
            ->update([
                'status' => 'Ditolak',
            ]);

        if ($output == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Menolak Peminjaman Barang dengan Kode Pinjaman ' . $kode_pinjam . '';
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Menolak Peminjaman Barang dengan Kode Pinjaman ' . $kode_pinjam . '';
        }

        return $response;
    }

    public function detail_pengembalian($id)
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

        return view('peminjaman.admin.terima_pengembalian', [
            'title' => 'Data Peminjaman',
            'peminjaman' => $peminjaman,
            'barang' => $data_barang,
            'pinjaman' => $data_pinjam
        ])->with('no');
    }

    public function terimaPengembalian(Request $request)
    {
        $kode_pinjam = $request->kode_pinjam;
        $id_pinjam = $request->id_pinjam;

        $peminjaman = DB::table('peminjaman')->where('id', $id_pinjam)->where('kode_pinjam', $kode_pinjam)->get();

        $data_barang_id = json_decode($peminjaman[0]->barang_id);
        $data_jumlah_pinjaman = json_decode($peminjaman[0]->jumlah_pinjaman);

        $mytime = Carbon::now();

        if ($request->keterangan_proses == 'Peminjaman') {
            for ($j = 0; $j < count($data_barang_id); $j++) {
                $barang_id = $data_barang_id[$j];
                $jumlah_pinjam = $data_jumlah_pinjaman[$j];
                $stokBarang2 = DB::table('barang_detail')->where('id', $barang_id)->first();
                $descade2 = DB::table('barang_detail')->where('id', $barang_id)->update(['stok_barang' => $stokBarang2->stok_barang + $jumlah_pinjam]);
                $output2 = DB::table('peminjaman')->where('kode_pinjam', $kode_pinjam)->where('id', $id_pinjam)->update(['status' => 'Diterima', 'keterangan_proses' => 'Pengembalian', 'updated_at' => $mytime->toDateTimeString()]);

                $response['success'] = true;
                $response['message'] = 'Anda Berhasil Menyetujui Pengembalian Barang dengan Kode Pinjaman ' . $kode_pinjam . '';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Menyetujui Pengembalian Barang dengan Kode Pinjaman ' . $kode_pinjam . '';
        }

        return $response;
    }

    public function halpdf()
    {
        return view('peminjaman.admin.halpdf', [
            'title' => 'Data Peminjaman'
        ]);
    }

    public static function PeminjamancetakPDF(Request $request)
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
            $pdf->loadView('peminjaman.admin.cetak_peminjaman_admin', ['peminjaman' => $peminjaman, 'barang' => $data_barang, 'pinjaman' => $data_pinjam]);
            return $pdf->download('Laporan-Peminjaman-Admin' . ($mytime->toDateString()) . '.pdf');
        } else {
            $response['success'] = false;
            $response['message'] = 'Tidak Memiliki Data Peminjaman Dalam Jangka Waktu Tersebut';
        }
        return $response;
    }
}
