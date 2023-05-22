<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/forgot_password', function () {
    return view('auth.forgot_password');
});

Route::get('/reset_password', function () {
    return view('auth.reset_password');
});

Route::get('/home', function () {
    return view('home');
});


Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/admin-page', function () {
    return 'Halaman untuk Admin';
})->middleware('role:admin')->name('admin.page');

Route::get('pimpinan-page', function () {
    return 'Halaman untuk pimpinan';
})->middleware('role:pimpinan')->name('pimpinan.page');

Route::get('pegawai-page', function () {
    return 'Halaman untuk pegawai';
})->middleware('role:pegawai')->name('pegawai.page');
