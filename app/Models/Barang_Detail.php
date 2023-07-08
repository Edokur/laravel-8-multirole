<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang_Detail extends Model
{
    use HasFactory;

    protected $table = 'barang_detail';

    protected $fillable = [
        'kode_barang', 'nama_barang', 'tanggal_registrasi', 'pendistribusian', 'jumlah_barang', 'brand_barang', 'harga_barang', 'tanggal_pembelian', 'kondisi_barang', 'umurekonomis_barang', 'spesifikasi'
    ];

    public function Barang()
    {
        return $this->belongsTo('App\Barang');
    }
}
