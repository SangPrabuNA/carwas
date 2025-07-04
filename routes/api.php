<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bookings\Booking; // <-- Tambahkan ini

// ... (route lain yang mungkin sudah ada)

Route::post('/schedules', [Booking::class, 'store']);