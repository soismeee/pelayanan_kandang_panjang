<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::post('/regist', [AuthController::class, 'store']);

Route::get('/', [DashbaordController::class, 'index'])->middleware('auth');
Route::get('/home', [DashbaordController::class, 'index'])->name('home')->name('auth');
Route::post('/storePelanggan', [DashbaordController::class, 'store'])->middleware('auth');

Route::resource('/pengguna', PenggunaController::class)->middleware('auth');
Route::post('/jsonPengguna', [PenggunaController::class, 'json'])->middleware('auth');
Route::post('/penggunaDel/{id}', [PenggunaController::class, 'destroy'])->middleware('auth');
Route::post('/penggunaAct/{id}', [PenggunaController::class, 'isActive'])->middleware('auth');

Route::get('/data-pengajuan', [PelayananController::class, 'index'])->middleware('auth');
Route::get('/form-pengajuan', [PelayananController::class, 'create'])->middleware('auth');
Route::post('/storePengajuan', [PelayananController::class, 'store'])->middleware('auth');
Route::post('/jsonPengajuan', [PelayananController::class, 'json'])->middleware('auth');
Route::post('/pengajuanDel/{id}', [PelayananController::class, 'destroy'])->middleware('auth');


Route::get('/create_pengajuan_lhr', [PelayananController::class, 'createKelahiran'])->middleware('auth');
Route::get('/pengajuan_kelahiran', [PelayananController::class, 'indexKelahiran'])->middleware('auth');
Route::get('/riwayat_kelahiran', [PelayananController::class, 'riwayatKelahiran'])->middleware('auth');
Route::post('/jsonKelahiran', [PelayananController::class, 'jsonKelahiran'])->middleware('auth');
Route::post('/jsonRiwayatKelahiran', [PelayananController::class, 'jsonRiwayatKelahiran'])->middleware('auth');

Route::get('/create_pengajuan_mt', [PelayananController::class, 'createKematian'])->middleware('auth');
Route::get('/pengajuan_kematian', [PelayananController::class, 'indexKematian'])->middleware('auth');
Route::post('/jsonKematian', [PelayananController::class, 'jsonKematian'])->middleware('auth');
Route::post('/jsonRiwayatKematian', [PelayananController::class, 'jsonRiwayatKematian'])->middleware('auth');
Route::get('/riwayat_kematian', [PelayananController::class, 'riwayatKematian'])->middleware('auth');


Route::get('/laporan_lhr', [LaporanController::class, 'indexKelahiran'])->middleware('auth');
Route::get('/laporan_mt', [LaporanController::class, 'indexKematian'])->middleware('auth');
