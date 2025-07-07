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
            'car_id' => 'required|exists:cars,id',
            'service_id' => 'required|exists:services,id',
            'tanggal_masuk' => 'required|date',
            'jam_masuk' => 'required',
        ]);

        // Cek otorisasi (pastikan mobil milik user)
        $car = \App\Models\Car::find($validated['car_id']);
        if ($car->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $service = \App\Models\Service::find($validated['service_id']);

        $request->user()->schedules()->create([
            'car_id' => $validated['car_id'],
            'service_id' => $validated['service_id'],
            'tanggal_masuk' => $validated['tanggal_masuk'],
            'jam_masuk' => $validated['jam_masuk'],
            'tanggal_selesai' => $validated['tanggal_masuk'],
            'jam_keluar' => date('H:i', strtotime($validated['jam_masuk'] . ' + ' . $service->duration . ' hours')),
            'status' => 'Pending',
        ]);

        return response()->json(['message' => 'Booking schedule created successfully!'], 201);
    }                                                     
}