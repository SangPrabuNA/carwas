@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
    <div class="bg-white p-8 md:p-12 rounded-lg shadow-xl max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Booking Details #{{ $schedule->id }}</h2>

        <div class="border-b pb-6">
            <div class="flex justify-between text-sm">
                <div>
                    <p class="text-gray-500">Service</p>
                    <p class="font-semibold text-gray-800">{{ $schedule->service->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-500">Schedule</p>
                    <p class="font-semibold text-gray-800">{{ $schedule->tanggal_masuk->format('d M, Y') }}, {{ date('H:i', strtotime($schedule->jam_masuk)) }}</p>
                </div>
            </div>
        </div>

        <div class="py-6">
            <p class="text-gray-500 text-sm mb-2">ITEM DETAIL</p>
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-semibold text-gray-800">{{ $schedule->service->name }}</p>
                    <p class="text-sm text-gray-500">{{ $schedule->car->name }}</p>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-gray-800">Rp {{ number_format($schedule->service->price) }}</p>
                    <p class="text-sm text-gray-500">Rate</p>
                </div>
            </div>
        </div>

        <div class="border-t pt-6 space-y-2">
            <div class="flex justify-between">
                <p class="text-gray-600">Subtotal</p>
                <p class="font-semibold text-gray-800">Rp {{ number_format($schedule->service->price) }}</p>
            </div>
            <div class="flex justify-between font-bold text-lg">
                <p>Total</p>
                <p>Rp {{ number_format($schedule->service->price) }}</p>
            </div>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('profile.edit') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-8 rounded-lg">Back to Profile</a>
        </div>
    </div>
@endsection