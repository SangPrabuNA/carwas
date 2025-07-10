@extends('layouts.admin')

@section('title', 'Jadwal Booking')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">JADWAL BOOKING</h1>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-md mb-8">
        <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center space-x-4">
            {{-- Dropdown Bulan --}}
            <select name="month" class="p-2 border border-gray-300 rounded-lg">
                <option value="">All Months</option> @foreach ($months as $monthNumber => $monthName)
                    <option value="{{ $monthNumber }}" {{ $selectedMonth == $monthNumber ? 'selected' : '' }}>
                        {{ $monthName }}
                    </option>
                @endforeach
            </select>

            {{-- Dropdown Tahun --}}
            <select name="year" class="p-2 border border-gray-300 rounded-lg">
                <option value="">All Years</option> @foreach ($years as $year)
                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Filter</button>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-blue-600 text-sm">Reset</a>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3">ID</th>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Layanan</th>
                        <th class="p-3">Jadwal</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Pekerja</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 font-medium">{{ $booking->id }}</td>
                            <td class="p-3 font-medium">{{ $booking->user?->name ?? 'N/A' }}</td>
                            <td class="p-3">{{ $booking->service?->name ?? 'N/A' }}</td>
                            <td class="p-3">
                                {{ $booking->tanggal_masuk->format('d M Y') }}
                                <span class="text-gray-500">{{ date('H:i', strtotime($booking->jam_masuk)) }}</span>
                            </td>
                            
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($booking->status == 'Pending') bg-yellow-100 text-yellow-800 @endif
                                    @if($booking->status == 'Confirmed') bg-blue-100 text-blue-800 @endif
                                    @if($booking->status == 'Finished') bg-green-100 text-green-800 @endif
                                    @if($booking->status == 'Canceled') bg-red-100 text-red-800 @endif
                                    @if($booking->status == 'Rejected') bg-red-100 text-red-800 @endif
                                ">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="p-3 font-medium text-gray-700">
                                {{ $booking->worker?->name ?? 'Belum Ditugaskan' }}
                            </td>
                            <td class="p-3">
                                <a href="{{ route('admin.schedules.edit', $booking) }}" class="bg-blue-500 text-white px-4 py-1 rounded-md text-xs hover:bg-blue-600">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-gray-500">Tidak ada data booking untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection