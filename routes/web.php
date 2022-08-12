<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangExpiredController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\KelolaBarangController;

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
    return view('tampilan.user');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::POST('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('orang gudang', [AuthController::class, 'orang_gudang'])->name('orang gudang');
    Route::get('admin', [AuthController::class, 'admin'])->name('admin');
    Route::get('pimpinan', [AuthController::class, 'pimpinan'])->name('pimpinan');
    Route::POST('logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('kelola_akun')->group(function () {
        Route::get('dashboard', [AkunController::class, 'dashboard'])->name('dashboard');
        Route::get('index', [AkunController::class, 'index'])->name('kelola_akun');
        Route::get('tambah', [AkunController::class, 'create'])->name('akun_tambah');
        Route::POST('tambah', [AkunController::class, 'store'])->name('akun_tambah');
        Route::get('edit/{id}', [AkunController::class, 'edit'])->name('akun_edit');
        Route::POST('edit/{id}', [AkunController::class, 'update'])->name('akun_edit');
        Route::DELETE('hapus/{id}', [AkunController::class, 'destroy'])->name('akun_delete');
    });

    Route::prefix('kelola_barang')->group(function () {
        Route::get('index', [KelolaBarangController::class, 'index'])->name('kelola_barang');
        Route::get('tambah', [KelolaBarangController::class, 'create'])->name('barang_tambah');
        Route::POST('tambah', [KelolaBarangController::class, 'store'])->name('barang_tambah');
        Route::get('edit/{id_kelola_barang}', [KelolaBarangController::class, 'edit'])->name('barang_edit');
        Route::POST('edit/{id_kelola_barang}', [KelolaBarangController::class, 'update'])->name('barang_edit');
        Route::DELETE('hapus/{id_kelola_barang}', [KelolaBarangController::class, 'destroy'])->name('barang_delete');
    });

    Route::prefix('master_stok')->group(function () {
        Route::get('index', [StokController::class, 'index'])->name('kelola_stok');
        Route::get('histori', [StokController::class, 'histori'])->name('histori');
        Route::POST('cari_histori', [StokController::class, 'cari'])->name('cari');
        Route::get('tambah', [StokController::class, 'create'])->name('stok_tambah');
        Route::POST('tambah', [StokController::class, 'store'])->name('stok_tambah');
        Route::POST('ajax', [StokController::class, 'ajax_stok'])->name('ajax_stok');
        Route::get('edit/{id_stok}', [StokController::class, 'edit'])->name('stok_edit');
        Route::POST('edit/{id_stok}', [StokController::class, 'update'])->name('stok_edit');
        Route::DELETE('hapus/{id_stok}', [StokController::class, 'destroy'])->name('stok_delete');
    });

    Route::prefix('barang_keluar')->group(function () {
        Route::get('index', [BarangKeluarController::class, 'index'])->name('kelola_barang_keluar');
        Route::get('pengeluaran_stok', [BarangKeluarController::class, 'create'])->name('pengeluaran_stok');
        Route::POST('pengeluaran_stok', [BarangKeluarController::class, 'store'])->name('pengeluaran_stok');
        Route::POST('ajax', [BarangKeluarController::class, 'ajax_jual'])->name('ajax_jual');
        Route::POST('ajax_detail_stok', [BarangKeluarController::class, 'ajax_detailStok'])->name('ajax_detail_stok');
        Route::get('histori', [BarangKeluarController::class, 'histori'])->name('histori_barang_keluar');

        Route::DELETE('barang_keluar/hapus/{id_barang_keluar}', [BarangKeluarController::class, 'destroy_barang_keluar'])->name('barang_keluar_delete');
    });

    Route::prefix('laporan')->group(function () {
        Route::get('laporan', [LaporanController::class, 'laporan'])->name('laporan');
        Route::get('laporan_masuk', [LaporanController::class, 'laporan_masuk'])->name('laporan_masuk');
        Route::get('laporan_expired', [LaporanController::class, 'expired'])->name('laporan_expired');

        // DELETE
        Route::DELETE('laporan_masuk/hapus/{id_histori_stok}', [LaporanController::class, 'destroy_laporan_masuk'])->name('laporan_masuk_delete');
        Route::DELETE('laporan_expired/hapus/{id_histori_stok}', [LaporanController::class, 'destroy_laporan_expired'])->name('laporan_expired_delete');
    });

    Route::prefix('cetak')->group(function () {
        Route::get('cetak_laporan', [LaporanController::class, 'cetak_laporan'])->name('cetak_laporan');
        Route::get('cetak_laporan_masuk', [LaporanController::class, 'cetak_laporan_masuk'])->name('cetak_laporan_masuk');
        Route::get('laporan_expired', [LaporanController::class, 'cetak_laporan_expired'])->name('cetak_laporan_expired');
    });
});
