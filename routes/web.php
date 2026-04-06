<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\DaftarUlangController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AdminController;

// ==========================================
// PUBLIC ROUTES
// ==========================================
Route::get('/', function () {
    return view('welcome');
});

// Pengumuman Hasil Seleksi (Publik)
Route::get('/pengumuman', [PengumumanController::class, 'index']);
Route::post('/pengumuman/cek', [PengumumanController::class, 'cek'])->name('pengumuman.cek');

// ==========================================
// AUTH ROUTES (Guest Only)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);
});

// ==========================================
// SANTRI DASHBOARD ROUTES
// ==========================================
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('dashboard')->group(function () {
        // Beranda Dashboard
        Route::get('/', [DashboardController::class, 'index']);

        // Identitas Diri (Biodata)
        Route::get('/identitas', [IdentitasController::class, 'index']);
        Route::post('/identitas', [IdentitasController::class, 'store'])->name('identitas.store');

        // Dokumen Berkas
        Route::get('/dokumen', [DokumenController::class, 'index']);
        Route::post('/dokumen/upload', [DokumenController::class, 'upload'])->name('dokumen.upload');

        // Biaya Pendaftaran
        Route::get('/biaya-pendaftaran', [DaftarUlangController::class, 'index']);
        Route::post('/biaya-pendaftaran', [DaftarUlangController::class, 'upload'])->name('biaya-pendaftaran.upload');
    });
});

// ==========================================
// ADMIN ROUTES
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/pendaftar', [AdminController::class, 'pendaftar']);
    Route::get('/verifikasi/{id}', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');
    Route::post('/dokumen/{id}/update', [AdminController::class, 'updateDokumen'])->name('admin.dokumen.update');
    Route::get('/seleksi/{id}', [AdminController::class, 'seleksi'])->name('admin.seleksi');
    Route::post('/seleksi/{id}', [AdminController::class, 'simpanSeleksi'])->name('admin.seleksi.simpan');
    Route::post('/pembayaran/{id}/verifikasi', [AdminController::class, 'verifikasiPembayaran'])->name('admin.pembayaran.verifikasi');
});
