<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarWashController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\DashboardController;

// Semua route untuk website harus ada di dalam grup ini
Route::middleware('web')->group(function () {

    // Route untuk Halaman Utama
    Route::get('/', [CarWashController::class, 'index'])->name('home');

    // Route untuk Otentikasi
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route untuk Halaman Profil (Dilindungi Auth)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

    // Route untuk Mobil (Dilindungi Auth)
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store')->middleware('auth');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit')->middleware('auth');
    Route::patch('/cars/{car}', [CarController::class, 'update'])->name('cars.update')->middleware('auth'); 

    // Route untuk Booking (Dilindungi Auth)
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create')->middleware('auth');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store')->middleware('auth');

    // Grup Route untuk Admin
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Nanti kita tambahkan route lain di sini
    });
});