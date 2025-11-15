<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PeriodePenilaianController;
use App\Http\Controllers\PenilaianController;

// Auth Routes
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Karyawan
    Route::resource('karyawan', KaryawanController::class);

    // Kriteria
    Route::resource('kriteria', KriteriaController::class);

    // Periode Penilaian
    Route::resource('periode', PeriodePenilaianController::class);

    // Penilaian
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('/penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
    Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::post('/penilaian/hitung', [PenilaianController::class, 'hitung'])->name('penilaian.hitung');
    Route::get('/penilaian/hasil', [PenilaianController::class, 'hasil'])->name('penilaian.hasil');
});
