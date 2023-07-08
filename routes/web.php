<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdashboardController;
use App\Http\Controllers\Barang_detailController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ForgotpasswordController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PdashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\ProfileController;
use App\Models\Barang_Detail;

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




route::group(['middleware' => ['guest']], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/forget_password', [ForgotpasswordController::class, 'index'])->name('forget.get');
    Route::post('/forget_password', [ForgotpasswordController::class, 'submitForgetPasswordForm'])->name('forget.post');

    Route::get('/reset_password/{token}', [ForgotpasswordController::class, 'index_reset'])->name('reset.get');
    Route::post('/reset_password', [ForgotpasswordController::class, 'submitResetPassword'])->name('reset.post');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::controller(PenggunaController::class)->group(function () {
// Route::get('/pengguna', 'index')->middleware('can:read pengguna');      //membuat tidak bisa diakses
// Route::get('/pengguna', 'index');      //membuat tidak bisa diakses
// Route::get('pengguna/create', 'create');
// });

Route::group(['middleware' => ['auth', 'cekrole:Admin']], function () {
    // Route::get('/dashboard', [DashboardController::class, 'index']);
    // Route::resource('pengguna', PenggunaController::class);
    route::get('/pengguna', [PenggunaController::class, 'index']);
    Route::post('/pengguna/changestatus', [PenggunaController::class, 'changestatus']);
    Route::post('/pengguna/store', [PenggunaController::class, 'store']);
    Route::get('/pengguna/edit/{id}', [PenggunaController::class, 'edit']);
    Route::post('/pengguna/update', [PenggunaController::class, 'update']);
    Route::post('/pengguna/destroy/{id}', [PenggunaController::class, 'destroy']);
    Route::get('/pengguna/detail/{id}', [PenggunaController::class, 'detail']);

    route::get('/perhitungan', [PerhitunganController::class, 'index']);
    route::get('/perhitungan/halpdf', [PerhitunganController::class, 'halpdf']);

    route::get('/peminjaman', [PeminjamanController::class, 'index']);
    route::get('/keranjang', [KeranjangController::class, 'index']);


    route::get('/barang', [BarangController::class, 'index']);
    route::post('/barang/store', [BarangController::class, 'store']);
    route::get('/barang/halpdf', [BarangController::class, 'halpdf']);
    route::post('/barang/halpdf/cetakpdf', [BarangController::class, 'BarangcetakPDF']);
    route::get('/barang/detail/{id}', [BarangController::class, 'detail']);
    route::post('/barang/detail/{id}/store', [BarangController::class, 'detailstore']);
    route::post('/barang/detail/{id}/update', [BarangController::class, 'detailupdate']);
    route::post('/barang/detail/{id}/datadetail', [BarangController::class, 'datadetail']);
    route::post('/barang/detail/{id}/delete_detailBarang', [BarangController::class, 'delete_detailBarang']);
    route::post('/barang/detail/{id}/qrcode', [BarangController::class, 'qrcode']);
    // route::get('/barang/detail', [Barang_detailController::class, 'index']);
    // Route::get('/pengguna/json', [PenggunaController::class, 'json']);
    // Route::get('/test', fn () => phpinfo());
});

Route::group(['middleware' => ['auth', 'cekrole:Pimpinan']], function () {
    // Route::get('/dashboard', [DashboardController::class, 'index']);
    // route::get('/pengguna', [PenggunaController::class, 'index']);
});

Route::group(['middleware' => ['auth', 'cekrole:Admin,Pegawai,Pimpinan']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/profile/changefoto', [ProfileController::class, 'changefoto']);
    Route::post('/profile/changepassword', [ProfileController::class, 'changepassword']);
});
