<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CarWashController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController; 

Route::get('/', [CarWashController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/schedules', [BookingController::class, 'index']);
Route::post('/schedules', [BookingController::class, 'store']);
Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');

