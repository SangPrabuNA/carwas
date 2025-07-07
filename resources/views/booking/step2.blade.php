@extends('layouts.app')

@section('title', 'Booking - Step 2')

@section('content')
    {{-- Stepper Navigation --}}
    <div class="w-full max-w-2xl mx-auto mb-12">
        {{-- ... Kode untuk stepper visual (dengan Langkah 2 aktif) ... --}}
    </div>

    <div class="bg-white p-8 md:p-12 rounded-lg shadow-xl max-w-4xl mx-auto">
        <form action="{{ route('booking.step2.store') }}" method="POST">
            @csrf

            <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Choose Date</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Kalender --}}
                <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
                    <input type="date" name="tanggal_masuk" 
                           value="{{ $bookingData['tanggal_masuk'] ?? date('Y-m-d') }}" 
                           class="w-full p-2 border-gray-300 rounded-md" 
                           required>
                    {{-- Untuk UI kalender yang lebih interaktif, diperlukan library JS tambahan.
                         Untuk saat ini, kita gunakan input date standar yang fungsional. --}}
                </div>

                {{-- Slot Waktu --}}
                <div>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($timeSlots as $time)
                            <div class="relative">
                                <input type="radio" name="jam_masuk" id="time-{{ $time }}" value="{{ $time }}" class="peer sr-only" required
                                       {{ (isset($bookingData['jam_masuk']) && $bookingData['jam_masuk'] == $time) ? 'checked' : '' }}>
                                <label for="time-{{ $time }}" class="block p-3 border rounded-lg cursor-pointer text-center transition-all peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600">
                                    {{ $time }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-10">
                <a href="{{ route('booking.step1.create') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-8 rounded-lg">Back</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-lg">Next</button>
            </div>
        </form>
    </div>
@endsection