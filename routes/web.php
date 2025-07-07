<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarWashController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\WorkerController;
use App\Http\Controllers\MultiStepBookingController;


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

    Route::get('/booking/step-1', [MultiStepBookingController::class, 'createStep1'])->name('booking.step1.create')->middleware('auth');
    Route::post('/booking/step-1', [MultiStepBookingController::class, 'storeStep1'])->name('booking.step1.store')->middleware('auth');
    Route::get('/booking/step-2', [MultiStepBookingController::class, 'createStep2'])->name('booking.step2.create')->middleware('auth');
    Route::post('/booking/step-2', [MultiStepBookingController::class, 'storeStep2'])->name('booking.step2.store')->middleware('auth');
    Route::get('/booking/step-3', [MultiStepBookingController::class, 'createStep3'])->name('booking.step3.create')->middleware('auth');
    Route::post('/booking/step-3', [MultiStepBookingController::class, 'storeStep3'])->name('booking.step3.store')->middleware('auth');

    // Grup Route untuk Admin
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/customers/{user}', [CustomerController::class, 'show'])->name('customers.show');
        Route::delete('/customers/{user}', [CustomerController::class, 'destroy'])->name('customers.destroy');
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        
        Route::resource('services', ServiceController::class);
        Route::resource('workers', WorkerController::class);
    });
});