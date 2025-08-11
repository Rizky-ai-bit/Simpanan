<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\TransaksiController;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware(['authmiddleware'])->group(function () {

    Route::get('/simpanan', [App\Http\Controllers\SimpananController::class, 'index'])->name('simpan.index');
    Route::post('/simpanan/create', [App\Http\Controllers\SimpananController::class, 'create_simpanan'])->name('create_simpanan');
    Route::put('/simpanan/{id}', [SimpananController::class, 'update'])->name('simpanan.update');
    Route::get('simpanan/{hashed_id}', [TransaksiController::class, 'show'])->name('show.detail');
    Route::delete('/simpanan/{hashed_id}', [SimpananController::class, 'delete'])->name('simpanan.destroy');

    Route::post('/transaksi/create/{hashed_id}', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::get('/transaksi/pdf/{hashed_id}', [TransaksiController::class, 'pdf'])->name('transaksi.pdf');
    Route::delete('/transaksi/{hashed_id}', [TransaksiController::class, 'delete'])->name('transaksi.destroy');
});
