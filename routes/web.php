<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;

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
    return redirect('/welcome');
});

Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/barang', [BarangController::class, 'index']);
// Route::get('/', function () {
//     if (Auth::check()) {
//         Auth::logout();
//         session()->invalidate();
//         session()->regenerateToken();
//     }
//     return redirect()->route('login');
// });

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/proses', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {

});