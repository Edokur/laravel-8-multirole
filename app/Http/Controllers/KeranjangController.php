<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Keranjang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_pegawai()
    {
        $id_user = auth()->user()->id;
        $keranjang = Keranjang::latest()->where('user_id', $id_user)->paginate(10);

        return view('keranjang_pinjam.index_pegawai', compact('keranjang'), [
            'title' => 'Keranjang Pinjam'
        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function delete_keranjang(Request $request)
    {
        $deleted = DB::table('keranjang')->where('id',  $request->id_keranjang)->delete();
        if ($deleted == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Menghapus Barang Dari Keranjang';
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Menghapus Barang Dari Keranjang';
        }

        return $response;
    }

    public function ajukan_keranjang(Request $request)
    {
        $auto_db = DB::table('peminjaman')
            ->select(DB::raw('MAX(kode_pinjam) as kode_terbesar'))
            ->get();

        if ($auto_db[0]->kode_terbesar == null) {
            $kodePinjam = 'KP/BC/000' . $auto_db[0]->kode_terbesar;
        } else {
            $kodePinjam = $auto_db[0]->kode_terbesar;
        }
        $kodePinjam++;

        $id_user = auth()->user()->id;

        $data = DB::table('keranjang')->where('user_id', $id_user)->get();

        $barang_id = [];
        for ($i = 0; $i < count($data); $i++) {
            $barang_id[] = ($data[$i]->barang_id);
        }

        $jumlah_pinjaman = [];
        for ($j = 0; $j < count($data); $j++) {
            $jumlah_pinjaman[] = ($data[$j]->jumlah_pinjaman);
        }
        $mytime = Carbon::now();

        $peminjaman = new Peminjaman;
        $peminjaman->kode_pinjam = $kodePinjam;
        $peminjaman->user_id = $id_user;
        $peminjaman->barang_id = json_encode($barang_id);
        $peminjaman->tgl_pinjam = $mytime->toDateString();
        $peminjaman->tgl_kembali = $request->tgl_kembali;
        $peminjaman->terlambat = 0;
        $peminjaman->jumlah_pinjaman = json_encode($jumlah_pinjaman);
        $peminjaman->status = 'Diproses';
        $peminjaman->is_active = 1;
        $peminjaman->keterangan_proses = 'Peminjaman';
        $peminjaman->keterangan_peminjaman = $request->keterangan_pinjam;
        $output = $peminjaman->save();

        DB::table('keranjang')->where('user_id',  $id_user)->delete();
        if ($output == true) {
            $response['success'] = true;
            $response['message'] = 'Permintaan Peminjaman Barang Anda Sedang Berhasil Diproses';
        } else {
            $response['success'] = false;
            $response['message'] = 'Permintaan Peminjaman Barang Anda Sedang Gagal Diproses';
        }

        return $response;
    }
}
