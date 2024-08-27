<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RukunTetanggaController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\RiwayatPenghuniController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/masuk', [AuthController::class, 'index'])->name('formLogin');

// Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route::middleware(['auth:api'])->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//     Route::get('/rumah', [RumahController::class, 'index']);
//     Route::post('/rumah', [RumahController::class, 'store']);
//     Route::get('/rumah/{id}', [RumahController::class, 'show']);
//     Route::put('/rumah/{id}', [RumahController::class, 'update']);
//     Route::delete('/rumah/{id}', [RumahController::class, 'destroy']);

//     Route::get('/penghuni', [PenghuniController::class, 'index']);
//     Route::post('/penghuni', [PenghuniController::class, 'store']);
//     Route::get('/penghuni/{id}', [PenghuniController::class, 'show']);
//     Route::put('/penghuni/{id}', [PenghuniController::class, 'update']);
//     Route::delete('/penghuni/{id}', [PenghuniController::class, 'destroy']);

//     Route::get('/iuran', [IuranController::class, 'index']);
//     Route::post('/iuran', [IuranController::class, 'store']);
//     Route::get('/iuran/{id}', [IuranController::class, 'show']);
//     Route::put('/iuran/{id}', [IuranController::class, 'update']);
//     Route::delete('/iuran/{id}', [IuranController::class, 'destroy']);

//     Route::get('/pembayaran', [PembayaranController::class, 'index']);
//     Route::post('/pembayaran', [PembayaranController::class, 'store']);
//     Route::get('/pembayaran/{id}', [PembayaranController::class, 'show']);
//     Route::put('/pembayaran/{id}', [PembayaranController::class, 'update']);
//     Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy']);

//     Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
//     Route::post('/pengeluaran', [PengeluaranController::class, 'store']);
//     Route::get('/pengeluaran/{id}', [PengeluaranController::class, 'show']);
//     Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update']);
//     Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy']);

//     Route::get('/riwayat-penghuni', [RiwayatPenghuniController::class, 'index']);
//     Route::post('/riwayat-penghuni', [RiwayatPenghuniController::class, 'store']);
//     Route::get('/riwayat-penghuni/{id}', [RiwayatPenghuniController::class, 'show']);
//     Route::put('/riwayat-penghuni/{id}', [RiwayatPenghuniController::class, 'update']);
//     Route::delete('/riwayat-penghuni/{id}', [RiwayatPenghuniController::class, 'destroy']);

//     Route::get('/rukun-tetangga', [RukunTetanggaController::class, 'index']);
// });


