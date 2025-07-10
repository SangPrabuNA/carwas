@extends('layouts.admin')
@section('title', 'Edit Booking #' . $schedule->id)
@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Booking #{{ $schedule->id }}</h1>

    <div class="bg-white p-8 rounded-lg shadow-md max-w-4xl">
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div><p class="font-semibold">Customer:</p> <p>{{ $schedule->user->name }}</p></div>
            <div><p class="font-semibold">Mobil:</p> <p>{{ $schedule->car->name }}</p></div>
            <div><p class="font-semibold">Layanan:</p> <p>{{ $schedule->service->name }}</p></div>
            <div><p class="font-semibold">Jadwal:</p> <p>{{ $schedule->tanggal_masuk->format('d M Y') }} - {{ date('H:i', strtotime($schedule->jam_masuk)) }}</p></div>
        </div>

        <hr>

        <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Dropdown Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status Booking</label>
                    <select name="status" id="status" class="mt-1 block w-full p-2 border-gray-300 rounded-md shadow-sm">
                        <option value="Pending" {{ $schedule->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Confirmed" {{ $schedule->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Finished" {{ $schedule->status == 'Finished' ? 'selected' : '' }}>Finished</option>
                        <option value="Canceled" {{ $schedule->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                        <option value="Rejected" {{ $schedule->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                {{-- Dropdown Pekerja --}}
                <div>
                    <label for="worker_id" class="block text-sm font-medium text-gray-700">Assign Worker</label>
                    <select name="worker_id" id="worker_id" class="mt-1 block w-full p-2 border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Belum Ditugaskan --</option>
                        @foreach ($workers as $worker)
                            <option value="{{ $worker->id }}" {{ $schedule->worker_id == $worker->id ? 'selected' : '' }}>
                                {{ $worker->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end mt-8">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Update Booking</button>
            </div>
        </form>
    </div>
@endsection