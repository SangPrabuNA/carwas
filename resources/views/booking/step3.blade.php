@extends('layouts.app')

@section('title', 'Booking - Step 3')

@section('content')
    {{-- Stepper Navigation --}}
    <div class="w-full max-w-2xl mx-auto mb-12">
        {{-- ... Kode untuk stepper visual (dengan Langkah 3 aktif) ... --}}
    </div>

    <div class="bg-white p-8 md:p-12 rounded-lg shadow-xl max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Confirmation</h2>

        <div class="border-b pb-6">
            <div class="flex justify-between text-sm">
                <div>
                    <p class="text-gray-500">Service</p>
                    <p class="font-semibold text-gray-800">{{ $bookingData['service']->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-500">Schedule</p>
                    <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($bookingData['tanggal_masuk'])->format('d M, Y') }}, {{ date('H:i', strtotime($bookingData['jam_masuk'])) }}</p>
                </div>
            </div>
        </div>

        <div class="py-6">
            <p class="text-gray-500 text-sm mb-2">ITEM DETAIL</p>
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-semibold text-gray-800">{{ $bookingData['service']->name }}</p>
                    <p class="text-sm text-gray-500">{{ $bookingData['car']->name }}</p>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-gray-800">Rp {{ number_format($bookingData['service']->price) }}</p>
                    <p class="text-sm text-gray-500">Rate</p>
                </div>
            </div>
        </div>

        <div class="border-t pt-6 space-y-2">
            <div class="flex justify-between">
                <p class="text-gray-600">Subtotal</p>
                <p class="font-semibold text-gray-800">Rp {{ number_format($bookingData['service']->price) }}</p>
            </div>
            <div class="flex justify-between font-bold text-lg">
                <p>Total</p>
                <p>Rp {{ number_format($bookingData['service']->price) }}</p>
            </div>
        </div>

        <form action="{{ route('booking.step3.store') }}" method="POST">
            @csrf
            <div class="flex justify-between mt-10">
                <a href="{{ route('booking.step2.create') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-8 rounded-lg">Back</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-lg">Confirm</button>
            </div>
        </form>
    </div>
@endsection