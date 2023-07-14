<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasRoles, HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang', 'tanggal_registrasi', 'pendistribusian',
    ];

    protected $hidden = [
        'is_active',
    ];

    public function Barang_Detail()
    {
        return $this->hasMany('App\Barang_Detail');
    }
}
