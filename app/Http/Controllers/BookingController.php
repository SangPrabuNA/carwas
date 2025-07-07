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
        // Validasi data dari form
        $validated = $request->validate([
            'nama' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'jam_masuk' => 'required',
        ]);

        // Buat data schedule baru
        // Kita asumsikan user yang membuat adalah user yang sedang login
        // dan mobil yang dipilih juga ada di data request (jika diperlukan)
        $schedule = new Schedule();
        $schedule->nama = $validated['nama'];
        $schedule->tanggal_masuk = $validated['tanggal_masuk'];
        $schedule->jam_masuk = $validated['jam_masuk'];
        // Placeholder untuk tanggal dan jam selesai
        $schedule->tanggal_selesai = $validated['tanggal_masuk']; 
        $schedule->jam_keluar = '17:00'; 
        $schedule->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        // return redirect()->route('profile.edit')->with('status', 'Booking schedule created successfully!');

        // Untuk sekarang, kita kembalikan response JSON agar bisa ditangani Alpine.js
        return response()->json(['message' => 'Booking schedule created successfully!'], 201);
    }                                                       
}