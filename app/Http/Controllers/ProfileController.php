<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();

        // Ambil data booking milik user, urutkan dari yang terbaru
        // dan muat relasi service & car untuk ditampilkan di view
        $bookings = $user->schedules()->with(['service', 'car'])->latest()->get();

        // Kirim data user dan booking ke view
        return view('profile.edit', [
            'user' => $user,
            'bookings' => $bookings,
        ]);
    }

    /**
     * Method baru untuk meng-update profil pengguna.
     */
    public function update(Request $request)
    {
        // 1. Ambil data pengguna yang sedang login
        $user = $request->user();

        // 2. Validasi data yang masuk dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        // 3. Update data pengguna
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];

        // 4. Hanya update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // 5. Simpan perubahan ke database
        $user->save();

        // 6. Kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile.edit')->with('status', 'Profile successfully updated!');
    }
}