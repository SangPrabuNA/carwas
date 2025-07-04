<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CarWashController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Bookings\Booking;

Route::get('/', [CarWashController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/schedules', [Booking::class, 'index']);
Route::post('/schedules', [Booking::class, 'store']);




//require __DIR__.'/settings.php';
//require __DIR__.'/auth.php';
