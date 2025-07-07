<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// routes/api.php
use App\Http\Controllers\BookingController; // Sesuaikan jika perlu

Route::post('/schedules', [BookingController::class, 'store'])->name('booking.store')->middleware('auth');