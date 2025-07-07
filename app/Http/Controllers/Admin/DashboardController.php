<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data booking untuk ditampilkan
        $bookings = Schedule::latest()->get(); // Ambil data booking dari model Schedule

        return view('admin.dashboard', ['bookings' => $bookings]);
    }
}