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

Route::get('/create', [PelayananController::class, 'create'])->middleware('auth');
Route::get('/create_pengajuan_lhr', [PelayananController::class, 'create_lhr'])->middleware('auth');
Route::get('/create_pengajuan_mt', [PelayananController::class, 'create_mt'])->middleware('auth');

Route::get('/pengajuan_kelahiran', [PelayananController::class, 'index_lhr'])->middleware('auth');
Route::get('/pengajuan_kematian', [PelayananController::class, 'index_mt'])->middleware('auth');

Route::get('/laporan_lhr', [LaporanController::class, 'index_lhr'])->middleware('auth');
Route::get('/laporan_mt', [LaporanController::class, 'index_mt'])->middleware('auth');
