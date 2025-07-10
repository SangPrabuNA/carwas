<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Validation\Rule;

class MultiStepBookingController extends Controller
{
    public function createStep1(Request $request)
    {
        // Ambil data booking yang mungkin sudah ada di session
        $booking = $request->session()->get('booking', []);
        $cars = auth()->user()->cars;
        $services = Service::all();
        return view('booking.step1', compact('cars', 'services', 'booking'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'service_id' => 'required|exists:services,id',
        ]);

        // Langkah ini akan MENGGANTI session lama dengan data baru dari Step 1
        // Ini benar untuk langkah pertama.
        $request->session()->put('booking', $validated);

        return redirect()->route('booking.step2.create');
    }
    public function createStep2(Request $request)
    {
        // Ambil data booking yang sudah ada dari session
        $booking = $request->session()->get('booking', []);

        // Tentukan tanggal yang akan diperiksa. Ambil dari session, atau gunakan hari ini jika belum ada.
        $checkDate = $booking['tanggal_masuk'] ?? now()->toDateString();

        // Ambil semua jadwal yang sudah ada pada tanggal tersebut
        $bookedSchedules = Schedule::whereDate('tanggal_masuk', $checkDate)->get();

        // Buat array yang berisi semua jam yang sudah dibooking
        $bookedTimes = $bookedSchedules->pluck('jam_masuk')->map(function ($time) {
            return date('H:i', strtotime($time));
        })->toArray();

        // Daftar slot waktu yang tersedia
        $timeSlots = ["08:00", "09:00", "10:00", "11:00", "13:00", "14:00", "15:00", "16:00", "17:00"];

        // Kirim semua data yang diperlukan ke view
        return view('booking.step2', compact('booking', 'timeSlots', 'bookedTimes'));
    }

    public function storeStep2(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal_masuk' => 'required|date',
            'jam_masuk' => [
                'required',
                'string',
                // Aturan ini akan memeriksa tabel 'schedules'
                // dan hanya akan lolos jika kombinasi 'jam_masuk' dan 'tanggal_masuk' belum ada.
                Rule::unique('schedules')->where(function ($query) use ($request) {
                    return $query->where('tanggal_masuk', $request->tanggal_masuk);
                }),
            ],
        ], [
            // Pesan error kustom
            'jam_masuk.unique' => 'Jadwal pada tanggal dan jam ini sudah terisi. Silakan pilih waktu lain.'
        ]);

        // Ambil data yang sudah ada dari session
        $booking = $request->session()->get('booking', []);
        
        // Gabungkan data baru
        $booking = array_merge($booking, $validated);

        // Simpan kembali ke session
        $request->session()->put('booking', $booking);

        // Arahkan ke halaman step 3
        return redirect()->route('booking.step3.create');
    }

    public function createStep3(Request $request)
    {
        // Ambil data dari session dengan key 'booking'
        $bookingData = $request->session()->get('booking');

        // Jika data session kosong, kembalikan ke step 1 untuk mencegah error
        if (empty($bookingData)) {
            return redirect()->route('booking.step1.create');
        }

        // Ambil detail model Car dan Service berdasarkan ID dari session
        $bookingData['car'] = Car::find($bookingData['car_id']);
        $bookingData['service'] = Service::find($bookingData['service_id']);

        // Kirim variabel $bookingData ke view menggunakan compact()
        return view('booking.step3', compact('bookingData'));
    }

    public function storeStep3(Request $request)
    {
        $booking = $request->session()->get('booking');

        // Pengecekan: Jika tidak ada data di session, kembalikan ke Step 1
        if (empty($booking)) {
            return redirect()->route('booking.step1.create');
        }

        $service = Service::find($booking['service_id']);
        $jamSelesai = date('H:i:s', strtotime($booking['jam_masuk'] . ' + ' . $service->duration . ' hours'));

        auth()->user()->schedules()->create([
            'car_id' => $booking['car_id'],
            'service_id' => $booking['service_id'],
            'tanggal_masuk' => $booking['tanggal_masuk'],
            'jam_masuk' => $booking['jam_masuk'],
            'tanggal_selesai' => $booking['tanggal_masuk'],
            'jam_keluar' => $jamSelesai,
            'status' => 'Pending',
        ]);

        $request->session()->forget('booking');
        return redirect()->route('profile.edit')->with('success', 'Booking Anda telah berhasil dikonfirmasi!');
    }
    public function show(Schedule $schedule)
    {
        // Otorisasi: Pastikan pengguna hanya bisa melihat booking miliknya sendiri
        if ($schedule->user_id !== auth()->id()) {
            abort(403);
        }

        return view('booking.show', compact('schedule'));
    }
}