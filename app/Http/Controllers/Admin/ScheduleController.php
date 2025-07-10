<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\Worker;

class ScheduleController extends Controller
{
    // Method ini akan menampilkan halaman edit booking
    public function edit(Schedule $schedule)
    {
        // Ambil semua pekerja untuk ditampilkan di dropdown
        $workers = Worker::all();
        return view('admin.schedules.edit', compact('schedule', 'workers'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Confirmed,Finished,Canceled,Rejected',
            'worker_id' => 'nullable|exists:workers,id', // Validasi worker_id
        ]);

        $schedule->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Booking berhasil diperbarui.');
    }

    // ... method lain akan kita isi nanti ...
}