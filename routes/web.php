<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TransaksiController;

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

// Route::get('/', function () {
//     return redirect('/welcome');
// });
Route::get('/', function () {
    if (Auth::check()) {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/proses', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    //Barang (hanya untuk user login)
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/store', [BarangController::class, 'store']);
    Route::post('/barang/update/{idb}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/delete/{idb}', [BarangController::class, 'destroy'])->name('barang.destroy');

    //Users (hanya untuk admin/login)
    Route::get('/users', [UsersController::class, 'index']);

    //Transaksi (juga butuh login)
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/tambah/{id}', [TransaksiController::class, 'tambahKeranjang'])->name('transaksi.tambah');
    Route::get('/transaksi/kurang/{id}', [TransaksiController::class, 'kurangKeranjang'])->name('transaksi.kurang');
    Route::get('/transaksi/hapus/{id}', [TransaksiController::class, 'hapusKeranjang'])->name('transaksi.hapus');
    Route::post('/transaksi/checkout', [TransaksiController::class, 'checkout'])->name('transaksi.checkout');
    Route::get('/transaksi/riwayat/{id}', [TransaksiController::class, 'showRiwayat'])->name('transaksi.riwayat');
    Route::get('/transaksi/riwayat/{id}/cetak', [TransaksiController::class, 'cetakStruk'])->name('transaksi.cetak');
    Route::get('/transaksi/reset-keranjang', [TransaksiController::class, 'resetKeranjang'])->name('transaksi.reset');
    Route::get('/riwayat-transaksi', [TransaksiController::class, 'riwayatSemua'])->name('riwayat.semua');
    Route::get('/transaksi/riwayat', [TransaksiController::class, 'daftarRiwayat'])->name('transaksi.daftar');

    //Logout tetap bisa di dalam grup auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
