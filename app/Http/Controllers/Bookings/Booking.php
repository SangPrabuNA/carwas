<?php
namespace App\Http\Controllers\Bookings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\View\View; // <-- Tambahkan ini

class Booking extends Controller
{
    /**
     * Menampilkan halaman untuk membuat booking baru (front-end).
     */
    public function create(Request $request): View
    {
        // Data dummy untuk mobil dan service
        $dummyCars = [
            ['id' => 1, 'name' => 'DK 2801 FKD (BMW M4)'],
            ['id' => 2, 'name' => 'B 1234 ABC (Lamborghini)'],
        ];

        $dummyServices = [
            ['id' => 1, 'name' => 'Packet 1', 'price' => 99000, 'duration' => 1],
            ['id' => 2, 'name' => 'Packet 2', 'price' => 499000, 'duration' => 2],
            ['id' => 3, 'name' => 'Complete', 'price' => 799000, 'duration' => 3],
        ];

        return view('booking.create', [
            'user' => $request->user(),
            'cars' => $dummyCars,
            'services' => $dummyServices,
        ]);
    }

    // Menampilkan semua jadwal (method Anda sebelumnya)
    public function index()
    {
        $schedules = Schedule::all();
        return response()->json($schedules);
    }

    // Menyimpan jadwal baru (method Anda sebelumnya)
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