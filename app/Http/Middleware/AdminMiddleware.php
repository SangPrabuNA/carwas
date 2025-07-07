<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Periksa apakah user sudah login dan rolenya adalah 'admin'
        if (Auth::check() && Auth::user()->role == 'admin') {
            // 2. Jika ya, lanjutkan permintaan ke halaman selanjutnya
            return $next($request);
        }

        // 3. Jika tidak, kembalikan ke halaman utama (atau halaman 403 Forbidden)
        return redirect('/');
    }
}