<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter bulan dan tahun dari request. Defaultnya null.
        $selectedYear = $request->input('year');
        $selectedMonth = $request->input('month');

        // Mulai query dasar
        $bookingsQuery = Schedule::with(['user', 'car', 'service','worker']);

        // Terapkan filter HANYA JIKA ada nilai yang dipilih
        if ($selectedYear) {
            $bookingsQuery->whereYear('tanggal_masuk', $selectedYear);
        }
        if ($selectedMonth) {
            $bookingsQuery->whereMonth('tanggal_masuk', $selectedMonth);
        }

        // Eksekusi query
        $bookings = $bookingsQuery->latest()->get();
        
        // Data untuk mengisi dropdown
        $years = range(now()->year + 1, 2020);
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = date('F', mktime(0, 0, 0, $i, 1));
        }

        return view('admin.dashboard', compact('bookings', 'years', 'months', 'selectedYear', 'selectedMonth'));
    }
}