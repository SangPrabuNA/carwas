<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::latest()->get();
        return view('admin.workers.index', compact('workers'));
    }

    public function create()
    {
        return view('admin.workers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);
        Worker::create($validated);
        return redirect()->route('admin.workers.index')->with('success', 'Pekerja baru berhasil ditambahkan.');
    }

    public function edit(Worker $worker)
    {
        return view('admin.workers.edit', compact('worker'));
    }

    public function update(Request $request, Worker $worker)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);
        $worker->update($validated);
        return redirect()->route('admin.workers.index')->with('success', 'Data pekerja berhasil diperbarui.');
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();
        return redirect()->route('admin.workers.index')->with('success', 'Data pekerja berhasil dihapus.');
    }
}