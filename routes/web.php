<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/auth', [AuthController::class, 'authenticate']);

Route::get('/', [DashbaordController::class, 'index'])->middleware('auth');
Route::get('/home', [DashbaordController::class, 'index'])->name('home')->name('auth');

Route::resource('/pengguna', PenggunaController::class)->middleware('auth');

Route::get('/pengajuan_lhr', [PelayananController::class, 'index_lhr'])->middleware('auth');
Route::get('/pengajuan_mt', [PelayananController::class, 'index_mt'])->middleware('auth');

Route::get('/pengajuan_kelahiran', [PelayananController::class, 'dataPengajuanKelahiran'])->middleware('auth');
Route::get('/pengajuan_kematian', [PelayananController::class, 'dataPengajuanKematian'])->middleware('auth');

Route::get('/laporan_lhr', [LaporanController::class, 'index_lhr'])->middleware('auth');
Route::get('/laporan_mt', [LaporanController::class, 'index_mt'])->middleware('auth');
