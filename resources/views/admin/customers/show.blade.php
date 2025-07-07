@extends('layouts.admin')

@section('title', 'Customer Details')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Customer Details</h1>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <div class="grid grid-cols-4 gap-4">
            <div><p class="font-semibold">ID Customer:</p> <p>{{ $customer->id }}</p></div>
            <div><p class="font-semibold">Nama:</p> <p>{{ $customer->name }}</p></div>
            <div><p class="font-semibold">No Telepon:</p> <p>{{ $customer->phone }}</p></div>
            <div><p class="font-semibold">Email:</p> <p>{{ $customer->email }}</p></div>
        </div>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Kendaraan</h2>
    <div class="space-y-4">
        @forelse ($customer->cars as $car)
            <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
                <div class="flex items-center">
                    <img src="{{ $car->image ? asset('storage/' . $car->image) : 'https://via.placeholder.com/96x64.png?text=No+Image' }}" alt="{{ $car->brand }}" class="w-32 h-20 object-cover rounded-md mr-6">
                    <div>
                        <p class="font-bold text-xl text-gray-800">{{ $car->plate_number }}</p>
                        <p class="text-gray-600">{{ $car->model }}</p>
                        <p class="text-gray-600 font-semibold">{{ $car->brand }}</p>
                    </div>
                </div>
                <a href="{{ route('cars.edit', $car) }}" class="text-gray-400 hover:text-blue-600">
                     <svg class="w-6 h-6" ...>...</svg>
                </a>
            </div>
        @empty
            <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-500">
                Customer ini belum memiliki kendaraan.
            </div>
        @endforelse
    </div>
@endsection