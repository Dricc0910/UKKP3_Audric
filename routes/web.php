<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

// Sudah login
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Customer: buat pengaduan (harus sebelum route {pengaduan})
    Route::middleware('role:customer')->group(function () {
        Route::resource('pengaduan', PengaduanController::class)->only(['create', 'store']);
    });

    // Admin: dashboard, daftar akun, edit dan hapus pengaduan
    Route::middleware('role:admin')->group(function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::get('akun', [AkunController::class, 'index'])->name('akun.index');
        Route::resource('pengaduan', PengaduanController::class)->only(['edit', 'update', 'destroy']);
    });

    // Admin dan customer: lihat daftar dan detail (customer dibatasi di controller)
    Route::resource('pengaduan', PengaduanController::class)->only(['index', 'show']);
    Route::get('pengaduan/{pengaduan}/lampiran', [PengaduanController::class, 'lampiran'])->name('pengaduan.lampiran');
});



// Route mengatur url dan menentukan proses yang dijalankan penggunakan ketika mengakses
// middleware untuk cek udah login atau belum, bisa cek session, dan cek role