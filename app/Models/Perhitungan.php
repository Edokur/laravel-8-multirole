<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    use HasFactory;

    protected $table = 'perhitungan';

    protected $fillable = [
        'nama_barang', 'tanggal_registrasi', 'pendistribusian',
    ];

    protected $hidden = [
        'is_active',
    ];
}
