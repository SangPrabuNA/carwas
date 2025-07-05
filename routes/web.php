<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CarWashController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController; 
use App\Http\Controllers\ProfileController; 

Route::get('/', [CarWashController::class, 'index'])->name('home');
// Route untuk Otentikasi (Publik)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route untuk Pengguna yang Sudah Login (Dilindungi Middleware)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit')
    ->middleware('auth');

Route::get('/booking/create', [Booking::class, 'create'])
    ->name('booking.create')
    ->middleware('auth');


