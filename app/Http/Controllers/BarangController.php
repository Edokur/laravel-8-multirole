<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use BaconQrCode\Writer;
use App\Helpers\Helpers;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\Barang_Detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use BaconQrCode\Renderer\ImageRenderer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $barang = Barang::all();
        if ($request->ajax()) {
            $allData = DataTables::of($barang)
                ->addIndexColumn()
                ->addColumn('jumlah', function ($row) {
                    return $this->jumlahBarang($row->id);
                })
                ->rawColumns(['jumlah'])
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/barang/detail/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailBarang"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>' .
                        '<a href="javascript:void(0)" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="delete" class="delete btn btn-danger btn-sm deleteBarang"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }

        return view('barang.index', compact('barang'), [
            'title' => 'Data Barang',
        ]);
    }

    public function jumlahBarang($id)
    {
        $jumlah_barang = DB::table('barang_Detail')
            ->where('barang_id', $id)
            ->get();

        return json_encode(count($jumlah_barang));
    }

    public function halpdf()
    {
        $barang = DB::table('barang_detail as bd')
            ->select('*')
            ->leftJoin('barang as b', 'bd.barang_id', '=', 'b.id')
            ->get();
        // dd($barang);
        return view('barang.halpdf', compact('barang'), [
            'title' => 'Data Barang'
        ]);
    }

    public static function BarangcetakPDF(Request $request)
    {
        // dd("tanggal awal :" . $request->tanggal_awal, "tanggal akhir :" . $request->tanggal_akhir);
        // $cetak = Barang::with('Barang_Detail')->whereBetween('tanggal_registrasi', [$request->tanggal_awal, $request->tanggal_akhir]);
        $cetak = DB::table('barang_detail as bd')
            ->select('*')
            ->leftJoin('barang as b', 'bd.barang_id', '=', 'b.id')
            ->whereBetween('tanggal_registrasi', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();
        // dd($cetak);
        // $pdf = PDF::loadview('barang.cetak_barang_pertanggal', compact('cetak'));
        // $pdf->setPaper('A4', 'potrait');
        // return $pdf->save('laporan-barang-pdf');
        // dd($cetak-);
        // if ($cetak->isEmpty()) {
        //     dd($cetak);
        // } else {
        //     dd("ada data");
        // }

        if ($cetak->isNotEmpty()) {
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('barang.cetak_barang_pertanggal', compact('cetak'));
            return $pdf->download('Laporan-barang.pdf');
        } else {
            $response['success'] = false;
            $response['message'] = 'Tidak Memiliki Data Barang Dalam Jangka Waktu Tersebut';
        }
        return $response;
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'registrasi_barang' => 'required',
            'pendistribusian_barang' => 'required',
        ]);

        // $arr = explode(" ", $request->nama_barang);
        // $singkatan_nama = "";
        // foreach ($arr as $kata) {
        //     $singkatan_nama .= substr($kata, 0, 1);
        // }
        // dd($singkatan_nama);

        $barang = new Barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->tanggal_registrasi = $request->registrasi_barang;
        $barang->pendistribusian = $request->pendistribusian_barang;
        $output = $barang->save();

        if ($output == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Menambahkan Data Barang';
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Menambahkan Data Barang';
        }

        return $response;
    }

    public function detail($id)
    {
        $barang = DB::table('barang_detail as bd')
            ->select('bd.id', 'bd.kode_barang', 'bd.brand_barang', 'bd.harga_barang', 'bd.kondisi_barang', 'bd.qr_code', 'bd.jumlah_barang')
            ->leftJoin('barang as b', 'bd.barang_id', '=', 'b.id')
            ->where('barang_id', $id)
            ->get();

        if (request()->ajax()) {
            $allData = DataTables::of($barang)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle-"tooltip" data-kode_barang="' . $row->kode_barang . '" data-original-title="edit" class="mr-1 edit btn btn-primary btn-sm editdetailBarang">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg></a>' . '
                    <a href="javascript:void(0)" data-toggle-"tooltip" data-kode_barang="' . $row->kode_barang . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm modaldetailBarang"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>' .
                        '<a href="javascript:void(0)" data-toggle-"tooltip" data-kode_barang="' . $row->kode_barang . '" data-original-title="delete" class="delete btn btn-danger btn-sm deletedetailBarang"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }

        $data_barang = DB::table('barang')
            ->where('id', $id)
            ->get();

        return view('barang.detail', compact('barang'), [
            'title' => 'Data Barang',
            'nama_barang' => $data_barang[0]->nama_barang,
            'id_barang' => $data_barang[0]->id
        ]);
    }

    public function detailupdate(Request $request)
    {
        $kode_barang = $request->kode_barang;
        $output = DB::table('barang_detail')
            ->where('kode_barang', $kode_barang)
            ->update([
                'brand_barang' => $request->brand_barang,
                'harga_barang' => $request->harga_barang,
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'jumlah_barang' => $request->jumlah_barang,
                'kondisi_barang' => $request->kondisi_barang,
                'umurekonomis_barang' => $request->umurekonomis_barang,
                'spesifikasi' => $request->spesifikasi,
            ]);

        if ($output == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Mengupdate Data Barang';
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Mengupdate Data Barang';
        }

        return $response;
    }

    public function datadetail(Request $request)
    {
        $kode_barang = $request->kode_barang;
        $barang = DB::table('barang_detail')
            ->leftJoin('barang', 'barang_detail.barang_id', '=', 'barang.id')
            ->where('barang_detail.kode_barang', $kode_barang)
            ->get();

        if ($barang[0]->qr_code == null) {
            $path = public_path('assets/img/qrcode/' . $kode_barang . '.png');

            $data = QrCode::format('png')
                ->size(580)->color(0, 0, 0)->backgroundColor(255, 255, 255)->errorCorrection('H')->margin(2)
                ->generate(url($kode_barang), $path);
            $output_file = $kode_barang . '.png';
            // $output_file = 'img-' . $kode_barang . '.png';
            // $data = Storage::disk('public')->put($output_file, $image);

            $output = DB::table('barang_detail')
                ->where('kode_barang', $kode_barang)
                ->update([
                    'qr_code' => $output_file,
                ]);
        }
        // else {
        //     if (Barang_Detail::where('qr_code', $kode_barang)->exists()) {
        //         if ($request->kode_barang != '') {
        //             $image = Barang_Detail::where('qr_code', $kode_barang)->first();
        //             dd($image);
        //             $file_path = public_path('assets/img/qrcode/' . $kode_barang . '.png');
        //             // $data_path = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file_path);
        //             if ($file_path != null) {
        //                 unlink($file_path);
        //             }
        //             // $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('file_photo')->getClientOriginalName());
        //             $data = QrCode::format('png')
        //                 ->merge('\public\assets\img\logo-beecon.png', .3)
        //                 ->size(500)->errorCorrection('H')
        //                 ->generate($kode_barang, $file_path);
        //             $output_file = $kode_barang . '.png';
        //             // $output_file = 'img-' . $kode_barang . '.png';
        //             // $data = Storage::disk('public')->put($output_file, $image);

        //             $output = DB::table('barang_detail')
        //                 ->where('kode_barang', $kode_barang)
        //                 ->update([
        //                     'qr_code' => $output_file,
        //                 ]);
        //         }
        //     }
        // }

        return $barang;
    }

    public function detailstore(Request $request)
    {
        $arr = explode(" ", $request->nama_barang);
        $singkatan_nama_barang = "";
        foreach ($arr as $kata) {
            $singkatan_nama_barang .= substr($kata, 0, 1);
        }
        $arr = explode(" ", $request->brand_barang);
        $singkatan_brand_barang = "";
        foreach ($arr as $kata) {
            $singkatan_brand_barang .= substr($kata, 0, 1);
        }
        $auto_db = DB::table('barang_detail')
            ->select(DB::raw('MAX(kode_barang) as kode_terbesar'))
            ->where('barang_id', $request->barang_id)
            ->get();

        if ($auto_db[0]->kode_terbesar == null) {
            $kodeBarang = $singkatan_nama_barang . $singkatan_brand_barang . '000' . $auto_db[0]->kode_terbesar;
        } else {
            $kodeBarang = $auto_db[0]->kode_terbesar;
        }
        $kodeBarang++;

        $barang = new Barang_Detail;
        $barang->kode_barang = $kodeBarang;
        $barang->barang_id = $request->barang_id;
        $barang->brand_barang = $request->brand_barang;
        $barang->jumlah_barang = $request->jumlah_barang;
        $barang->harga_barang = $request->harga_barang;
        $barang->tanggal_pembelian = $request->tanggal_pembelian;
        $barang->kondisi_barang = $request->kondisi_barang;
        $barang->umurekonomis_barang = $request->umurekonomis_barang;
        $barang->spesifikasi = $request->spesifikasi;
        $output = $barang->save();

        if ($output == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Menambahkan Data Barang';
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Menambahkan Data Barang';
        }

        return $response;
    }

    public function delete_detailBarang(Request $request)
    {
        $deleted = DB::table('barang_detail')->where('kode_barang',  $request->kode_barang)->delete();
        if ($deleted == true) {
            $response['success'] = true;
            $response['message'] = 'Anda Berhasil Menghapus Data Barang';
        } else {
            $response['success'] = false;
            $response['message'] = 'Anda Gagal Menghapus Data Barang';
        }

        return $response;
    }

    public function qrcode(Request $request)
    {
        $request->qrcode;

        $data = DB::table('barang_detail')
            ->where('kode_barang', $request->qrcode)
            ->get();

        // dd($data[0]->qr_code);
        $ha = public_path() . '\assets\img\qrcode\\' . $request->qrcode . '.png';

        // dd($ha);
        // $filepath = Storage::disk('public')->get($data[0]->qr_code);
        return Response::download($ha);
        // $images = File::allFiles(public_path('\assets\img\qrcode'));
        // print_r($images);
        // return response()->download($ha);
    }

    // Halaman pegawai 

    public function index_pegawai(Request $request)
    {
        $barang_pegawai = Barang::all();
        if ($request->ajax()) {
            $allData = DataTables::of($barang_pegawai)
                ->addIndexColumn()
                ->addColumn('jumlah', function ($row) {
                    return $this->jumlahBarang($row->id);
                })
                ->rawColumns(['jumlah'])
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/barang_pegawai/detail/' . $row->id . '" data-toggle-"tooltip" data-id="' . $row->id . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm detailBarang"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }

        return view('barang.index_pegawai', compact('barang_pegawai'), [
            'title' => 'Data Barang',
        ]);
    }

    public function detail_pegawai($id)
    {
        $barang_detail = DB::table('barang_detail as bd')
            ->select('bd.id', 'bd.kode_barang', 'bd.brand_barang', 'bd.harga_barang', 'bd.kondisi_barang', 'bd.jumlah_barang')
            ->leftJoin('barang as b', 'bd.barang_id', '=', 'b.id')
            ->where('barang_id', $id)
            ->get();

        if (request()->ajax()) {
            $allData = DataTables::of($barang_detail)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle-"tooltip" data-kode_barang="' . $row->kode_barang . '" data-original-title="detail" class="mr-1 detail btn btn-info btn-sm modaldetailBarangPegawai"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm48 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM64 288c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V352c0-35.3-28.7-64-64-64H64zm280 72a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm56 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $allData;
        }

        $data_barang = DB::table('barang')
            ->where('id', $id)
            ->get();

        return view('barang.detail_pegawai', compact('barang_detail'), [
            'title' => 'Data Barang',
            'nama_barang' => $data_barang[0]->nama_barang,
        ]);
    }
}
