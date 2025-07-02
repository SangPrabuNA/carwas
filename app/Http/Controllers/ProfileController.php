<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // <-- Pastikan 'use' statement ini ditambahkan

class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profil dengan data dummy.
     */
    public function edit(): View // <-- INI METHOD YANG HILANG
    {
        // Membuat data user palsu (dummy)
        $dummyUser = (object) [
            'name' => 'Ananta',
            'email' => 'anantadummy@gmail.com',
            'phone' => '+6281234567890',
            'address' => 'Jl. Dummy Profile No. 123',
        ];

        // Membuat data mobil palsu (dummy)
        $dummyCars = [
            (object) [
                'image' => 'https://images.unsplash.com/photo-1616422285421-9BC2b0a1f934?q=80&w=300',
                'plate_number' => 'DK 2801 FKD',
                'brand' => 'BMW',
                'model' => 'M4',
            ],
            (object) [
                'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=300',
                'plate_number' => 'B 1234 ABC',
                'brand' => 'Lamborghini',
                'model' => 'Aventador',
            ],
        ];

        return view('profile.edit', [
            'user' => $dummyUser,
            'cars' => $dummyCars,
        ]);
    }

    // Nanti kita bisa tambahkan fungsi lain seperti update() di sini
}