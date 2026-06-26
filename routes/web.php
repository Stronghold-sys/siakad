<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;

// Halaman utama / Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Operasi penulisan data CRUD Mahasiswa dilindungi dengan Rate Limiter "form_submit"
Route::middleware('throttle:form_submit')->group(function () {
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});

// Operasi pembacaan data Mahasiswa (tidak menggunakan rate limiting ketat)
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
