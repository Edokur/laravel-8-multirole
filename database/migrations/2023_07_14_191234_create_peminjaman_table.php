<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pinjam')->unique();
            $table->text('barang_id');
            $table->string('user_id');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->string('terlambat');
            $table->string('jumlah_pinjaman');
            $table->enum('status', ['Diproses', 'Dipinjam', 'Ditolak', 'Diterima'])->default('Diproses');
            $table->enum('is_active', ['1', '0'])->default('0');
            $table->enum('keterangan_proses', ['Peminjaman', 'Pengembalian'])->default('Peminjaman');
            $table->longText('keterangan_peminjaman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
