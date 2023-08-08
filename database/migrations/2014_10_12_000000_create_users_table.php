<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            // $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', ['Admin', 'Pimpinan', 'Pegawai'])->default('Pegawai');
            $table->enum('is_active', ['1', '0'])->default('0');
            $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable();
            $table->string('username');
            $table->string('jabatan');
            $table->string('nohp');
            $table->text('alamat');
            $table->longText('biografi')->nullable();
            $table->string('photo')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
