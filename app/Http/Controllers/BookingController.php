<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\View\View;
use App\Models\Service; 
use App\Models\Car; 

class BookingController extends Controller
{
    /**
     * Menampilkan halaman untuk membuat booking baru (front-end).
     */
    public function create(Request $request): View
    {
        $user = $request->user();
        $cars = []; // Siapkan variabel cars sebagai array kosong

        // HANYA JIKA ADA USER YANG LOGIN, kita ambil data mobilnya
        if ($user) {
            $cars = $user->cars()->get();
        }

        // Ambil semua data service dari database
        $services = Service::all();

        return view('booking.create', [
            'user' => $user,
            'cars' => $cars,
            'services' => $services,
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