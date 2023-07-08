<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerhitunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perhitungan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->dateTime('harga_perolehan');
            $table->string('tarif_penyusutan');
            $table->string('hasil_perhitungan');
            $table->string('brand_barang');
            $table->string('harga_barang');
            $table->string('tanggal_perhitungan');
            $table->string('umurekonomis_barang');
            $table->enum('is_active', ['1', '0'])->default('0');
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
        Schema::dropIfExists('perhitungan');
    }
}
