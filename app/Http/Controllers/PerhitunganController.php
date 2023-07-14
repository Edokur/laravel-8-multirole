<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Perhitungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Facades\DataTables;
use SebastianBergmann\CodeUnit\FunctionUnit;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perhitungan = Perhitungan::all();

        if ($request->ajax()) {
            $allData = DataTables::of($perhitungan)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="delete" class="delete btn btn-danger btn-sm deletePerhitungan"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }

        $barang = DB::table('barang_detail as bd')
            ->select('*')
            ->leftJoin('barang as b', 'bd.barang_id', '=', 'b.id')
            ->get();
        return view('perhitungan.index', compact('barang'), [
            'title' => 'Data Perhitungan'
        ]);
    }

    public function data_barang(Request $request)
    {
        $data = DB::table('barang_detail as bd')
            ->select('*')
            ->leftJoin('barang as b', 'bd.barang_id', '=', 'b.id')
            ->where('bd.kode_barang', $request->kode_barang)
            ->get();
        return $data;
    }

    public function store(Request $request)
    {
        $response['success'] = '';
        $response['message'] = '';
        $request->validate([
            'harga_perolehan' => 'required',
            'tarif_penyusutan' => 'required',
            'umurekonomis_barang' => 'required',
            'hasil_perhitungan' => 'required',
        ]);

        $cek_data = DB::table('perhitungan')->where('kode_barang', $request->kode_barang)->first();

        $mytime = Carbon::now();

        if ($cek_data == null) {
            $perhitungan = new Perhitungan;
            $perhitungan->kode_barang = $request->kode_barang;
            $perhitungan->nama_barang = $request->nama_barang;
            $perhitungan->brand_barang = $request->brand_barang;
            $perhitungan->harga_perolehan = $request->harga_perolehan;
            $perhitungan->harga_barang = $request->harga_perolehan;
            $perhitungan->tarif_penyusutan = $request->tarif_penyusutan;
            $perhitungan->umurekonomis_barang = $request->umurekonomis_barang;
            $perhitungan->hasil_perhitungan = $request->hasil_perhitungan;
            $perhitungan->is_active = '1';
            $perhitungan->tanggal_perhitungan = $mytime->toDateString();
            $output = $perhitungan->save();

            if ($output == true) {
                $response['success'] = true;
                $response['message'] = 'Anda Berhasil Menambahkan Data Perhitungan';
            } else {
                $response['success'] = false;
                $response['message'] = 'Anda Gagal Menambahkan Data Perhitungan';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Data Perhitungan Tersebut Sudah Tersedia';
        }
        return $response;
    }

    public function destroy($id)
    {

        $deleted = DB::table('perhitungan')->where('id',  $id)->delete();
        if ($deleted == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Menghapus Data Perhitungan';
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Menghapus Data Perhitungan';
        }

        return $response;
    }

    public function halpdf()
    {
        return view('perhitungan.halpdf', [
            'title' => 'Data Perhitungan'
        ]);
    }

    public static function PerhitungancetakPDF(Request $request)
    {
        $cetak = DB::table('perhitungan')
            ->whereBetween('tanggal_perhitungan', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();

        if ($cetak->isNotEmpty()) {
            $pdf = App::make('dompdf.wrapper');
            $pdf->setPaper('a4', 'landscape');
            $pdf->loadView('perhitungan.cetak_perhitungan', compact('cetak'));
            return $pdf->download('Laporan-Perhitungan(' . $request->tanggal_awal . $request->tanggal_akhir . ').pdf');
        } else {
            $response['success'] = false;
            $response['message'] = 'Tidak Memiliki Data Barang Dalam Jangka Waktu Tersebut';
        }
        return $response;
    }
}
