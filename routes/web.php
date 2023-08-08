<?php

use GuzzleHttp\Middleware;
use App\Models\Barang_Detail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AdashboardController;
use App\Http\Controllers\PdashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\Barang_detailController;
use App\Http\Controllers\ForgotpasswordController;
use App\Http\Controllers\PeminjamanPegawaiController;
use App\Http\Controllers\PeminjamanPimpinanController;

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
    route::get('/pengguna', [PenggunaController::class, 'index']);
    Route::post('/pengguna/changestatus', [PenggunaController::class, 'changestatus']);
    Route::post('/pengguna/store', [PenggunaController::class, 'store']);
    Route::get('/pengguna/edit/{id}', [PenggunaController::class, 'edit']);
    Route::post('/pengguna/update', [PenggunaController::class, 'update']);
    Route::post('/pengguna/destroy/{id}', [PenggunaController::class, 'destroy']);
    Route::get('/pengguna/detail/{id}', [PenggunaController::class, 'detail']);

    route::get('/perhitungan', [PerhitunganController::class, 'index']);
    route::post('/perhitungan/store', [PerhitunganController::class, 'store']);
    route::post('/perhitungan/destroy/{id}', [PerhitunganController::class, 'destroy']);
    route::post('/perhitungan/data_barang', [PerhitunganController::class, 'data_barang']);
    route::get('/perhitungan/halpdf', [PerhitunganController::class, 'halpdf']);
    route::post('/perhitungan/halpdf/cetakpdf', [PerhitunganController::class, 'PerhitungancetakPDF']);

    route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.admin');
    route::get('/peminjaman/halpdf', [PeminjamanController::class, 'halpdf']);
    route::post('/peminjaman/halpdf/cetakpdf', [PeminjamanController::class, 'PeminjamancetakPDF']);
    route::get('/peminjaman/index_detail/{id}', [PeminjamanController::class, 'index_detail']);
    route::get('/peminjaman/detail/{id}', [PeminjamanController::class, 'detail']);
    route::post('/peminjaman/detail/{id}/terimaPeminjaman', [PeminjamanController::class, 'terimaPeminjaman']);
    route::post('/peminjaman/detail/{id}/tolakPeminjaman', [PeminjamanController::class, 'tolakPeminjaman']);
    route::get('/peminjaman/detail_pengembalian/{id}', [PeminjamanController::class, 'detail_pengembalian']);
    route::post('/peminjaman/detail_pengembalian/{id}/terimaPengembalian', [PeminjamanController::class, 'terimaPengembalian']);

    route::get('/terpinjam_table', [PeminjamanController::class, 'terpinjam_table']);
    route::get('/selesai_table', [PeminjamanController::class, 'selesai_table']);
    route::get('/pengajuan_table', [PeminjamanController::class, 'pengajuan_table']);
    route::get('/dibatalkan_table', [PeminjamanController::class, 'dibatalkan_table']);

    route::get('/barang', [BarangController::class, 'index']);
    route::post('/barang/store', [BarangController::class, 'store']);
    route::post('/barang/delete', [BarangController::class, 'delete']);
    route::get('/barang/halpdf', [BarangController::class, 'halpdf']);
    route::post('/barang/halpdf/cetakpdf', [BarangController::class, 'BarangcetakPDF']);
    route::get('/barang/detail/{id}', [BarangController::class, 'detail']);
    route::post('/barang/detail/{id}/store', [BarangController::class, 'detailstore']);
    route::post('/barang/detail/{id}/update', [BarangController::class, 'detailupdate']);
    route::post('/barang/detail/{id}/datadetail', [BarangController::class, 'datadetail']);
    route::post('/barang/detail/{id}/delete_detailBarang', [BarangController::class, 'delete_detailBarang']);
    route::post('/barang/detail/{id}/qrcode', [BarangController::class, 'qrcode']);
    // Route::get('/test', fn () => phpinfo());

});

Route::group(['middleware' => ['auth', 'cekrole:Pegawai']], function () {
    route::get('/peminjaman_pegawai', [PeminjamanPegawaiController::class, 'index'])->name('peminjaman.pegawai');
    route::get('/peminjaman_pegawai/informasi_barang/{id}', [PeminjamanPegawaiController::class, 'informasi_barang'])->name('informasi_barang');
    route::post('/peminjaman_pegawai/informasi_barang/{id}/store', [PeminjamanPegawaiController::class, 'storeKeranjang']);
    route::get('/peminjaman_pegawai/index_detail_pegawai/{id}', [PeminjamanPegawaiController::class, 'index_detail']);
    route::get('/terpinjam_table_pegawai', [PeminjamanPegawaiController::class, 'terpinjam_table_pegawai']);
    route::get('/selesai_table_pegawai', [PeminjamanPegawaiController::class, 'selesai_table_pegawai']);
    route::get('/pengajuan_table_pegawai', [PeminjamanPegawaiController::class, 'pengajuan_table_pegawai']);
    route::get('/dibatalkan_table_pegawai', [PeminjamanPegawaiController::class, 'dibatalkan_table_pegawai']);

    route::get('/keranjang_pegawai', [KeranjangController::class, 'index_pegawai'])->name('keranjang');
    route::post('/keranjang_pegawai/delete_keranjang', [KeranjangController::class, 'delete_keranjang']);
    route::post('/keranjang_pegawai/ajukan_keranjang', [KeranjangController::class, 'ajukan_keranjang']);

    route::get('/barang_pegawai', [BarangController::class, 'index_pegawai']);
    route::get('/barang_pegawai/detail/{id}', [BarangController::class, 'detail_pegawai']);
    route::post('/barang_pegawai/detail/{id}/datadetail', [BarangController::class, 'datadetail']);
});

Route::group(['middleware' => ['auth', 'cekrole:Pimpinan']], function () {
    route::get('/peminjaman_pimpinan', [PeminjamanPimpinanController::class, 'index'])->name('peminjaman.pimpinan');
    route::get('/peminjaman_pimpinan/detail_pimpinan/{id}', [PeminjamanPimpinanController::class, 'detail']);
    route::get('/peminjaman_pimpinan/halpdf', [PeminjamanPimpinanController::class, 'halpdf_pimpinan']);
    route::post('/peminjaman_pimpinan/halpdf/cetakpdf', [PeminjamanPimpinanController::class, 'PeminjamancetakPDF_pimpinan']);

    route::get('/barang_pimpinan', [BarangController::class, 'index_pimpinan']);
    route::get('/barang_pimpinan/detail/{id}', [BarangController::class, 'detail_pimpinan']);
    route::post('/barang_pimpinan/detail/{id}/datadetail', [BarangController::class, 'datadetail']);
    route::get('/barang_pimpinan/halpdf', [BarangController::class, 'halpdf_pimpinan']);
    route::post('/barang_pimpinan/halpdf/cetakpdf', [BarangController::class, 'BarangcetakPDF_pimpinan']);
});

Route::group(['middleware' => ['auth', 'cekrole:Admin,Pegawai,Pimpinan']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/profile/changefoto', [ProfileController::class, 'changefoto']);
    Route::post('/profile/changepassword', [ProfileController::class, 'changepassword']);
});
