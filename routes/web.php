<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaliSiswaController;
use App\Http\Controllers\BerandaWaliController;
use App\Http\Controllers\BerandaOperatorController;

Route::prefix('operator')->middleware(['auth', 'auth.operator'])->group(function() {
    Route::get('beranda', [BerandaOperatorController::class, 'index'])->name('operator.beranda');
    Route::resource('user', UserController::class);
    Route::resource('wali', WaliController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('walisiswa', WaliSiswaController::class);
});

Route::prefix('wali')->middleware(['auth', 'auth.wali'])->group(function() {
    Route::get('beranda', [BerandaWaliController::class, 'index'])->name('wal.beranda');
});

Route::get('logout', function () {
    Auth::logout();
});




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
