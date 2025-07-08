@extends('layouts.admin')

@section('title', 'Jadwal Booking')

@section('content')
    <div x-data="calendar()" x-init="init()">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">JADWAL BOOKING</h1>

        <div class="max-w-2xl bg-white p-6 rounded-lg shadow-md mb-8">
            <div class="flex justify-between items-center mb-4">
                <button @click="prevMonth()" class="p-2 rounded-full hover:bg-gray-100">&lt;</button>
                <h2 class="font-bold text-xl" x-text="`${months[month]} ${year}`"></h2>
                <button @click="nextMonth()" class="p-2 rounded-full hover:bg-gray-100">&gt;</button>
            </div>
            <div class="grid grid-cols-7 gap-2 text-center text-sm text-gray-500 font-semibold mb-2">
                <template x-for="day in daysOfWeek" :key="day">
                    <div x-text="day"></div>
                </template>
            </div>
            <div class="grid grid-cols-7 gap-2 text-center">
                <template x-for="blank in blankDays">
                    <div></div>
                </template>
                <template x-for="day in daysInMonth" :key="day">
                    <div @click="selectedDate = new Date(year, month, day); console.log(selectedDate)"
                         class="p-2 rounded-full cursor-pointer hover:bg-blue-100"
                         :class="{ 'bg-blue-600 text-white': isToday(day) }"
                         x-text="day">
                    </div>
                </template>
            </div>
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
                                    <span class="px-2 py-1 text-xs rounded-full {{-- ... kelas status ... --}}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td class="p-3">
                                    <a href="#" class="bg-blue-500 text-white px-4 py-1 rounded-md text-xs hover:bg-blue-600">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center p-4 text-gray-500">Tidak ada data booking.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function calendar() {
            return {
                month: '',
                year: '',
                blankDays: [],
                daysInMonth: [],
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                selectedDate: null,

                init() {
                    const today = new Date();
                    this.month = today.getMonth();
                    this.year = today.getFullYear();
                    this.getDays();
                },
                isToday(day) {
                    const today = new Date();
                    const d = new Date(this.year, this.month, day);
                    return today.toDateString() === d.toDateString();
                },
                getDays() {
                    const days = new Date(this.year, this.month + 1, 0).getDate();
                    const firstDay = new Date(this.year, this.month).getDay();
                    
                    this.blankDays = Array.from({ length: firstDay }, (_, i) => i + 1);
                    this.daysInMonth = Array.from({ length: days }, (_, i) => i + 1);
                },
                prevMonth() {
                    this.month--;
                    if (this.month < 0) {
                        this.month = 11;
                        this.year--;
                    }
                    this.getDays();
                },
                nextMonth() {
                    this.month++;
                    if (this.month > 11) {
                        this.month = 0;
                        this.year++;
                    }
                    this.getDays();
                }
            }
        }
    </script>
@endsection