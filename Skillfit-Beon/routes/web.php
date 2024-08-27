<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\RiwayatPenghuniController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/auth', [AuthController::class, 'login'])->name('auth');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/rumah', [RumahController::class, 'index'])->name('rumah');
    Route::get('/rumah/create', [RumahController::class, 'create'])->name('rumah.create');
    Route::post('/rumah', [RumahController::class, 'store'])->name('rumah.store');
    Route::get('/rumah/{id}', [RumahController::class, 'show'])->name('rumah.show');
    Route::get('/rumah/{id}/edit', [RumahController::class, 'edit'])->name('rumah.edit');
    Route::put('/rumah/{id}', [RumahController::class, 'update'])->name('rumah.update');
    Route::delete('/rumah/{id}', [RumahController::class, 'destroy'])->name('rumah.destroy');

    Route::get('/penghuni', [PenghuniController::class, 'index'])->name('penghuni');
    Route::get('/penghuni/create', [PenghuniController::class, 'create'])->name('penghuni.create');
    Route::post('/penghuni', [PenghuniController::class, 'store'])->name('penghuni.store');
    Route::get('/penghuni/{id}', [PenghuniController::class, 'show'])->name('penghuni.show');
    Route::get('/penghuni/{id}/edit', [PenghuniController::class, 'edit'])->name('penghuni.edit');
    Route::put('/penghuni/{id}', [PenghuniController::class, 'update'])->name('penghuni.update');
    Route::delete('/penghuni/{id}', [PenghuniController::class, 'destroy'])->name('penghuni.destroy');

    Route::get('/iuran', [IuranController::class, 'index'])->name('iuran');
    Route::get('/iuran/create', [IuranController::class, 'create'])->name('iuran.create');
    Route::post('/iuran', [IuranController::class, 'store'])->name('iuran.store');
    Route::get('/iuran/{id}', [IuranController::class, 'show'])->name('iuran.show');
    Route::get('/iuran/{id}/edit', [IuranController::class, 'edit'])->name('iuran.edit');
    Route::put('/iuran/{id}', [IuranController::class, 'update'])->name('iuran.update');
    Route::delete('/iuran/{id}', [IuranController::class, 'destroy'])->name('iuran.destroy');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
    Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
    Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
    Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
    Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('/pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/{id}', [PengeluaranController::class, 'show'])->name('pengeluaran.show');
    Route::get('/pengeluaran/{id}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');

    Route::get('/riwayat-penghuni', [RiwayatPenghuniController::class, 'index'])->name('riwayat-penghuni');
    Route::get('/riwayat-penghuni/create', [RiwayatPenghuniController::class, 'create'])->name('riwayat-penghuni.create');
    Route::post('/riwayat-penghuni', [RiwayatPenghuniController::class, 'store'])->name('riwayat-penghuni.store');
    Route::get('/riwayat-penghuni/{id}', [RiwayatPenghuniController::class, 'show'])->name('riwayat-penghuni.show');
    Route::get('/riwayat-penghuni/{id}/edit', [RiwayatPenghuniController::class, 'edit'])->name('riwayat-penghuni.edit');
    Route::put('/riwayat-penghuni/{id}', [RiwayatPenghuniController::class, 'update'])->name('riwayat-penghuni.update');
    Route::delete('/riwayat-penghuni/{id}', [RiwayatPenghuniController::class, 'destroy'])->name('riwayat-penghuni.destroy');

});
