<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@caraka.id',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $pimpinan = User::create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@caraka.id',
            'password' => bcrypt('12345678'),
        ]);

        $pimpinan->assignRole('pimpinan');

        $pegawai = User::create([
            'name' => 'Pegawai',
            'email' => 'pegawai@caraka.id',
            'password' => bcrypt('12345678'),
        ]);

        $pegawai->assignRole('pegawai');
    }
}
