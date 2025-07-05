<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ... method showLoginForm() dan showRegisterForm() tetap sama ...
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Logika untuk Registrasi Pengguna Baru
     */
    public function register(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        // 2. Buat user baru di database
        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password), // Enkripsi password
        ]);

        // 3. Langsung login-kan user yang baru mendaftar
        Auth::login($user);

        // 4. Arahkan ke halaman profil
        return redirect()->route('profile.edit');
    }

    /**
     * Logika untuk Login Pengguna
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba lakukan otentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // 3. Jika berhasil, arahkan ke halaman profil
            return redirect()->intended(route('profile.edit'));
        }

        // 4. Jika gagal, kembali ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Logika untuk Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}