<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Service;

class CarWashController extends Controller
{
    public function index(): View
    {
        // Data untuk galeri
        $galleryImages = [
            ['url' => 'image1.png', 'alt' => 'Mobil Sport Abu-abu'],
            ['url' => 'image2.png', 'alt' => 'Mobil Sport Hitam'],
            ['url' => 'image3.png', 'alt' => 'Mobil Sport Kuning'],
        ];

        // Ambil data service dari database
        $services = Service::all();

        // Kirim SEMUA data dalam satu array ke view
        return view('Landing-Page', [
            'galleryImages' => $galleryImages,
            'services' => $services, // <-- $services sekarang ikut dikirim
        ]);
    }
}