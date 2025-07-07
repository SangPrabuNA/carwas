<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'plate_number' => 'required|string|max:20|unique:cars',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
        }

        // PASTIKAN ANDA MENGGUNAKAN BARIS DI BAWAH INI
        // Ini secara otomatis akan mengisi 'user_id'
        $request->user()->cars()->create([
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'plate_number' => $validated['plate_number'],
            'image' => $imagePath,
        ]);

        return redirect()->route('profile.edit')->with('status', 'New car added successfully!');
    }
}