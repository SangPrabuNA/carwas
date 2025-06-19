<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CarWashController;

Route::get('/', [CarWashController::class, 'index'])->name('home');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
