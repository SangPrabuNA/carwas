@extends('layouts.admin')

@section('title', 'Jadwal Booking')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">JADWAL BOOKING</h1>

    <div class="max-w-2xl bg-white p-6 rounded-lg shadow-md mb-8">
        <div class="flex justify-between items-center mb-4">
            <button>&lt;</button>
            <h2 class="font-bold text-xl">April 2025</h2>
            <button>&gt;</button>
        </div>
        </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3">ID Booking</th>
                        <th class="p-3">Durasi (jam)</th>
                        <th class="p-3">Tanggal Masuk</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr class="border-b">
                            <td class="p-3">{{ $booking->id }}</td>
                            <td class="p-3">{{-- Durasi --}}</td>
                            <td class="p-3">{{ $booking->tanggal_masuk->format('d M Y') }} <br> <span class="text-gray-500">{{ $booking->jam_masuk }}</span></td>
                            <td class="p-3">
                                <a href="#" class="bg-blue-500 text-white px-4 py-1 rounded-md text-xs">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-4">Tidak ada data booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection