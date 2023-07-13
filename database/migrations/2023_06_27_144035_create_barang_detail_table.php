<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->unsignedBigInteger('barang_id');
            $table->string('jumlah_barang');
            $table->string('brand_barang');
            $table->string('harga_barang');
            $table->date('tanggal_pembelian');
            $table->string('kondisi_barang');
            $table->string('umurekonomis_barang');
            $table->string('spesifikasi');
            $table->enum('is_active', ['1', '0'])->default('0');
            $table->string('img_barang')->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_detail');
    }
}
