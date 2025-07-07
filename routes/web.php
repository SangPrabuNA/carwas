<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarWashController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;

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

    // Route untuk Booking (Dilindungi Auth)
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create')->middleware('auth');

});