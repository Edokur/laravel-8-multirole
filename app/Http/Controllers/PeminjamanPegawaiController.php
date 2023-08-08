<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Collection;

class PeminjamanPegawaiController extends Controller
{
    public function index()
    {
        $id_user = auth()->user()->id;
        $peminjaman = Peminjaman::latest()->where('user_id', $id_user)->paginate(10);

        return view('peminjaman.pegawai.index_pegawai', compact('peminjaman'), [
            'title' => 'Data Peminjaman'
        ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function informasi_barang($kode_barang)
    {
        $barang = DB::table('barang_detail as bd')
            ->select('bd.id', 'bd.img_barang', 'b.nama_barang', 'bd.kode_barang', 'bd.brand_barang', 'bd.harga_barang', 'bd.kondisi_barang', 'bd.spesifikasi', 'bd.jumlah_barang', 'bd.stok_barang')
            ->leftJoin('barang as b', 'bd.barang_id', '=', 'b.id')
            ->where('bd.kode_barang', $kode_barang)
            ->get();
        return view('peminjaman.pegawai.informasi_barang', compact('barang'), [
            'title' => 'Data Peminjaman'
        ]);
    }

    public function terpinjam_table_pegawai(Request $request)
    {
        $id_user = auth()->user()->id;

        $peminjaman = DB::table('peminjaman as p')
            ->select('p.id', 'p.kode_pinjam', 'u.name', 'p.tgl_pinjam', 'p.status', 'p.terlambat', 'p.tgl_kembali', 'p.keterangan_proses', 'p.keterangan_peminjaman')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->where('status', 'Dipinjam')
            ->where('user_id', $id_user)
            ->get();
        if ($request->ajax()) {
            $allData = DataTables::of($peminjaman)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/peminjaman_pegawai/index_detail_pegawai/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailPengguna"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }
    }

    public function selesai_table_pegawai(Request $request)
    {
        $id_user = auth()->user()->id;

        $peminjaman = DB::table('peminjaman as p')
            ->select('p.id', 'p.kode_pinjam', 'u.name', 'p.tgl_pinjam', 'p.status', 'p.terlambat', 'p.tgl_kembali', 'p.keterangan_proses', 'p.keterangan_peminjaman')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->where('status', 'Diterima')
            ->where('user_id', $id_user)
            ->get();
        if ($request->ajax()) {
            $allData = DataTables::of($peminjaman)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/peminjaman_pegawai/index_detail_pegawai/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailPengguna"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }
    }

    public function pengajuan_table_pegawai(Request $request)
    {
        $id_user = auth()->user()->id;

        $peminjaman = DB::table('peminjaman as p')
            ->select('p.id', 'p.kode_pinjam', 'u.name', 'p.tgl_pinjam', 'p.status', 'p.terlambat', 'p.tgl_kembali', 'p.keterangan_proses', 'p.keterangan_peminjaman')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->where('status', 'Diproses')
            ->where('user_id', $id_user)
            ->get();
        if ($request->ajax()) {
            $allData = DataTables::of($peminjaman)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/peminjaman_pegawai/index_detail_pegawai/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailPengguna"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }
    }

    public function dibatalkan_table_pegawai(Request $request)
    {
        $id_user = auth()->user()->id;

        $peminjaman = DB::table('peminjaman as p')
            ->select('p.id', 'p.kode_pinjam', 'u.name', 'p.tgl_pinjam', 'p.status', 'p.terlambat', 'p.tgl_kembali', 'p.keterangan_proses', 'p.keterangan_peminjaman')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->where('status', 'Ditolak')
            ->where('user_id', $id_user)
            ->get();
        if ($request->ajax()) {
            $allData = DataTables::of($peminjaman)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/peminjaman_pegawai/index_detail_pegawai/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailPengguna"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }
    }

    public function storeKeranjang(Request $request)
    {
        $cek_barang = DB::table('barang_detail')->where('kode_barang', $request->kode_barang)->first();

        $request->validate([
            'jumlah_pinjaman' => 'required',
        ]);
        $cek = DB::table('keranjang')->where('barang_id', $request->barang_id)->first();

        if ($request->jumlah_pinjaman > 10) {
            $response['success'] = false;
            $response['message'] = 'Jumlah Maksimal Barang Yang dapat Dipinjam adalah 10 Barang';
        } else {
            if ($cek_barang->stok_barang > $request->jumlah_pinjaman) {
                if ($cek != null) {
                    $response['success'] = false;
                    $response['message'] = 'Barang Sudah Tersedia didalam Keranjang';
                } else {
                    $id_user = auth()->user()->id;

                    $keranjang = new Keranjang;
                    $keranjang->barang_id = $request->barang_id;
                    $keranjang->user_id = $id_user;
                    $keranjang->jumlah_pinjaman = $request->jumlah_pinjaman;
                    $keranjang->kode_barang = $request->kode_barang;
                    $keranjang->nama_barang = $request->nama_barang;
                    $keranjang->spesifikasi_barang = $request->spesifikasi_barang;
                    $keranjang->kondisi_barang = $request->kondisi_barang;
                    $keranjang->is_active = 1;
                    $output = $keranjang->save();

                    if ($output == true) {
                        $response['success'] = true;
                        $response['message'] = 'Anda Berhasil Menambahkan Barang Ke dalam Keranjang';
                    } else {
                        $response['success'] = false;
                        $response['message'] = 'Anda Gagal Menambahkan Barang Ke dalam Keranjang';
                    }
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Jumlah Stok Barang Tidak Cukup';
            }
        }

        return $response;
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

        return view('peminjaman.pegawai.index_detail_pegawai', [
            'title' => 'Data Peminjaman',
            'peminjaman' => $peminjaman,
            'barang' => $data_barang,
            'pinjaman' => $data_pinjam
        ])->with('no');
    }
}
