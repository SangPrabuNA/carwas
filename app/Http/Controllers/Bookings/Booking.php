<?php
namespace App\Http\Controllers\Bookings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class Booking extends Controller
{
    // Menampilkan semua jadwal
    public function index()
    {
        $schedules = Schedule::all();
        return response()->json($schedules);
    }

    // Menyimpan jadwal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'jam_masuk' => 'required',
            'tanggal_selesai' => 'required|date',
            'jam_keluar' => 'required',
        ]);

        $schedule = Schedule::create($validated);

        return response()->json($schedule, 201);
    }
}