<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('peminjaman.index', [
            'title' => 'Data Peminjaman'
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // Halaman Pegawai 
    public function index_pegawai()
    {
        return view('peminjaman.index_pegawai', [
            'title' => 'Data Peminjaman'
        ]);
    }

    public function informasi_barang($kode_barang)
    {
        // dd($id);

        $barang = DB::table('barang_detail')
            ->leftJoin('barang', 'barang_detail.barang_id', '=', 'barang.id')
            ->where('barang_detail.kode_barang', $kode_barang)
            ->get();
        // dd($barang);
        return view('peminjaman.informasi_barang', compact('barang'), [
            'title' => 'Keranjang Pinjam'
        ]);
    }
}
