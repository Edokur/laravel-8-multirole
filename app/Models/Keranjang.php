<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';

    protected $fillable = [
        'kode_pinjam', 'jumlah_pinjam', 'status',
    ];

    protected $hidden = [
        'is_active',
    ];
}
