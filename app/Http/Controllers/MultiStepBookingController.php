<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\User;

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
        $booking = $request->session()->get('booking');
        $timeSlots = ["08:00", "09:00", "10:00", "11:00", "13:00", "14:00", "15:00", "16:00", "17:00"];
        return view('booking.step2', compact('booking', 'timeSlots'));
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'tanggal_masuk' => 'required|date',
            'jam_masuk' => 'required|string',
        ]);

        // Ambil data yang sudah ada dari session
        $booking = $request->session()->get('booking', []);

        // GABUNGKAN data baru, JANGAN TIMPA
        $booking = array_merge($booking, $validated);

        // Simpan kembali data yang sudah lengkap
        $request->session()->put('booking', $booking);

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
            'status' => 'Confirmed',
        ]);

        $request->session()->forget('booking');
        return redirect()->route('profile.edit')->with('success', 'Booking Anda telah berhasil dikonfirmasi!');
    }
}