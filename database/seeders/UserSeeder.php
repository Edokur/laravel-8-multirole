<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Commands\CreatePermission;
use Spatie\Permission\Models\Permission as ModelsPermission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::beginTransaction();
        try {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@caraka.id',
                'password' => Hash::make('12345678'),
                'username' => 'admin',
                'jabatan' => 'admin',
                'nohp' => '082278765617',
                'alamat' => 'Yogyakarta',
                'photo' => '',
            ]);

            $pimpinan = User::create([
                'name' => 'Pimpinan',
                'email' => 'pimpinan@caraka.id',
                'username' => 'pimpinan',
                'password' => Hash::make('12345678'),
                'jabatan' => 'pimpinan',
                'nohp' => '08112121',
                'alamat' => 'Yogyakarta',
                'photo' => '',
            ]);

            $pegawai = User::create([
                'name' => 'Pegawai',
                'email' => 'pegawai@caraka.id',
                'username' => 'pegawai',
                'password' => Hash::make('12345678'),
                'jabatan' => 'pegawai',
                'nohp' => '083232',
                'alamat' => 'Yogyakarta',
                'photo' => '',
            ]);


            $role_admin = Role::create([
                'name' => 'admin',
            ]);
            $role_pegawai = Role::create([
                'name' => 'pegawai',
            ]);
            $role_pimpinan = Role::create([
                'name' => 'pimpinan',
            ]);

            $permission = ModelsPermission::create(['name' => 'read pengguna']);
            $permission = ModelsPermission::create(['name' => 'create pengguna']);
            $permission = ModelsPermission::create(['name' => 'update pengguna']);
            $permission = ModelsPermission::create(['name' => 'delete pengguna']);

            $role_admin->givePermissionTo('read pengguna');
            $role_admin->givePermissionTo('create pengguna');
            $role_admin->givePermissionTo('update pengguna');
            $role_admin->givePermissionTo('delete pengguna');

            $admin->assignRole('admin');
            $pegawai->assignRole('pegawai');
            $pimpinan->assignRole('pimpinan');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }
}
