<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // <-- Import model User

class CustomerController extends Controller
{
    public function index()
    {
        // Ambil semua user yang memiliki role 'user'
        // Kita juga memuat relasi 'cars' untuk menghitung jumlah kendaraan
        $customers = User::where('role', 'user')->withCount('cars')->latest()->get();

        return view('admin.customers.index', ['customers' => $customers]);
    }
    public function show(User $user)
    {
        // Memuat relasi 'cars' untuk user yang dipilih
        $user->load('cars');
        
        return view('admin.customers.show', ['customer' => $user]);
    }
    public function destroy(User $user)
    {
        // Pastikan tidak menghapus admin lain atau diri sendiri
        if ($user->role == 'admin') {
            return back()->with('error', 'Tidak bisa menghapus sesama admin.');
        }

        $user->delete();

        return back()->with('success', 'Customer berhasil dihapus.');
    }
}