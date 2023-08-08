<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data_user = DB::table('users')->get();
        $total_user = count($data_user);
        $data_peminjaman = DB::table('peminjaman')->get();
        $total_peminjaman = count($data_peminjaman);
        $data_jenisbarang = DB::table('barang')->get();
        $total_jenisbarang = count($data_jenisbarang);
        $data_barang = DB::table('barang_detail')->get();

        $total_barang = 0;
        for ($i = 0; $i < count($data_barang); $i++) {
            $total_barang += $data_barang[$i]->jumlah_barang;
        }

        $year = Carbon::now()->year;
        $januari = DB::table('barang')->whereMonth('tanggal_registrasi', '1')->whereYear('tanggal_registrasi', $year)->get();
        $februari = DB::table('barang')->whereMonth('tanggal_registrasi', '2')->whereYear('tanggal_registrasi', $year)->get();
        $maret = DB::table('barang')->whereMonth('tanggal_registrasi', '3')->whereYear('tanggal_registrasi', $year)->get();
        $april = DB::table('barang')->whereMonth('tanggal_registrasi', '4')->whereYear('tanggal_registrasi', $year)->get();
        $mei = DB::table('barang')->whereMonth('tanggal_registrasi', '5')->whereYear('tanggal_registrasi', $year)->get();
        $juni = DB::table('barang')->whereMonth('tanggal_registrasi', '6')->whereYear('tanggal_registrasi', $year)->get();
        $juli = DB::table('barang')->whereMonth('tanggal_registrasi', '7')->whereYear('tanggal_registrasi', $year)->get();
        $agustus = DB::table('barang')->whereMonth('tanggal_registrasi', '8')->whereYear('tanggal_registrasi', $year)->get();
        $september = DB::table('barang')->whereMonth('tanggal_registrasi', '9')->whereYear('tanggal_registrasi', $year)->get();
        $oktober = DB::table('barang')->whereMonth('tanggal_registrasi', '10')->whereYear('tanggal_registrasi', $year)->get();
        $november = DB::table('barang')->whereMonth('tanggal_registrasi', '11')->whereYear('tanggal_registrasi', $year)->get();
        $desember = DB::table('barang')->whereMonth('tanggal_registrasi', '12')->whereYear('tanggal_registrasi', $year)->get();

        $data = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Des'],
            'datasets' => [
                [
                    'label' => 'Pergerakan Barang',
                    'backgroundColor' => '#4E4FEB',
                    'data' => [count($januari), count($februari), count($maret), count($april), count($mei), count($juni), count($juli), count($agustus), count($september), count($oktober), count($november), count($desember)]
                ],
            ]
        ];

        //pegawai
        $id = auth()->user()->id;
        $data_peminjamanpegawai = DB::table('peminjaman')->where('user_id', $id)->where('status', 'Dipinjam')->where('keterangan_proses', 'Peminjaman')->get();
        $total_peminjamanpegawai = count($data_peminjamanpegawai);

        $peminjaman = Peminjaman::latest()->where('user_id', $id)->paginate(4);

        $date_now = Carbon::now()->toDateString();


        for ($i = 0; $i < $total_peminjamanpegawai; $i++) {
            $kode_pinjam = $data_peminjamanpegawai[$i]->kode_pinjam;
            $tgl_kembali = $data_peminjamanpegawai[$i]->tgl_kembali;
            if ($date_now > $tgl_kembali) {
                $tgl = Carbon::now()->diff($tgl_kembali);
                $output = DB::table('peminjaman')->where('kode_pinjam', $kode_pinjam)->update(['terlambat' => $tgl->d]);
            }
        }

        return view('dashboard', compact('data'), [
            'title' => 'Dashboard',
            'total_user' => $total_user,
            'total_peminjaman' => $total_peminjaman,
            'total_barang' => $total_barang,
            'total_jenisbarang' => $total_jenisbarang,
            'total_peminjamanpegawai' => $total_peminjamanpegawai,
            'peminjaman' => $peminjaman,
        ])->with('i');
    }
}
