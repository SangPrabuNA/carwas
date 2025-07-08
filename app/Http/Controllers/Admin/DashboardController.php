<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data booking dan muat relasi user, car, dan service
        // 'with()' akan mencegah error jika salah satu relasi tidak ada
        $bookings = Schedule::with(['user', 'car', 'service'])->latest()->get();

        return view('admin.dashboard', ['bookings' => $bookings]);
    }
}