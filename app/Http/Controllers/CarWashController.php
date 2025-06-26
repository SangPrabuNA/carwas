<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CarWashController extends Controller
{
    public function index(): View
    {
           $galleryImages = [
            ['url' => 'image1.png', 'alt' => 'Mobil Sport Abu-abu'],
            ['url' => 'image2.png', 'alt' => 'Mobil Sport Hitam'],
            ['url' => 'image3.png', 'alt' => 'Mobil Sport Kuning'],
            //
            // UNTUK MENAMBAH GAMBAR BARU, CUKUP TAMBAHKAN BARIS DI SINI
            // Contoh: ['url' => 'image4.png', 'alt' => 'Mobil Lainnya'],
            //
        ];

        // Kirim data ke view
        return view('Landing-Page', [
            'galleryImages' => $galleryImages
        ]);
        return view('Landing-Page');
    }
}
