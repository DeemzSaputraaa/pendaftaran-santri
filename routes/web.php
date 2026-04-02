<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;

// Landing Page (Beranda Non-Login)
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes (Real Implementation)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Calon Santri
    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            return view('dashboard.index');
        });
        
        Route::get('/pembayaran', function() {
            return view('dashboard.pembayaran');
        });

        Route::post('/pembayaran/checkout', [PaymentController::class, 'createInvoice'])->name('checkout');

        Route::get('/identitas', function() {
            return view('dashboard.identitas');
        });

        Route::get('/dokumen', function() {
            return view('dashboard.dokumen');
        });
    });
});
