<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini

class AuthController extends Controller
{
    // ... (method showRegisterForm dan register yang sudah ada) ...
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // ...
        return back()->with('success', 'Registration successful! (Placeholder)');
    }


    // ▼▼▼ TAMBAHKAN DUA METHOD BARU DI BAWAH INI ▼▼▼

    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm(): View
    {
        // Kita akan membuat file view ini di langkah berikutnya
        return view('auth.login');
    }

    /**
     * Memproses data dari form login.
     */
    public function login(Request $request)
    {
        // 1. Validasi data input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba lakukan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Jika berhasil, redirect ke halaman dashboard (atau halaman utama)
            return redirect()->intended('/'); // Ganti '/' dengan '/dashboard' jika ada
        }

        // 4. Jika gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}