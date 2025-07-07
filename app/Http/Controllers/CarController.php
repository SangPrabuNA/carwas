<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{

    public function edit(Car $car)
    {
        // Otorisasi: Pastikan pengguna yang login adalah pemilik mobil
        if ($car->user_id !== auth()->id()) {
            abort(403);
        }

        return view('cars.edit', ['car' => $car]);
    }

    public function update(Request $request, Car $car)
    {
        // Otorisasi
        if ($car->user_id !== auth()->id()) {
            abort(403);
        }

        // Validasi data
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'plate_number' => ['required', 'string', 'max:20', Rule::unique('cars')->ignore($car->id)],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Jika ada gambar baru yang di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            // Simpan gambar baru dan update path-nya
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        // Update data mobil di database
        $car->update($validated);

        return redirect()->route('profile.edit')->with('status', 'Car updated successfully!');
    }
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