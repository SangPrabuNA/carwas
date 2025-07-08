@extends('layouts.app') {{-- Atau layout lain yang sesuai --}}

@section('title', 'Booking - Step 1')

@section('content')
    {{-- Stepper Navigation --}}
    <div class="w-full max-w-2xl mx-auto mb-12">
        {{-- ... Kode untuk stepper visual ... --}}
    </div>

    <div class="bg-white p-8 md:p-12 rounded-lg shadow-xl max-w-4xl mx-auto">
        <form action="{{ route('booking.step1.store') }}" method="POST">
            @csrf

            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Choose Vehicle</h2>
            <select name="car_id" class="block w-full max-w-md mx-auto p-3 border-gray-300 rounded-md shadow-sm">
                <option value="">-- Select Your Vehicle --</option>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}" {{ old('car_id', $bookingData['car_id'] ?? null) == $car->id ? 'selected' : '' }}>
                        {{ $car->name }}
                    </option>
                @endforeach
            </select>

            <h2 class="text-2xl font-bold text-gray-800 my-8 text-center">Choose Service</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($services as $service)
                    <div class="relative">
                        <input type="radio" name="service_id" id="service-{{ $service->id }}" value="{{ $service->id }}" class="peer sr-only" {{ (isset($bookingData['service_id']) && $bookingData['service_id'] == $service->id) ? 'checked' : '' }}>
                        <label for="service-{{ $service->id }}" class="block p-4 border rounded-lg cursor-pointer text-center transition-all peer-checked:border-blue-600 peer-checked:ring-2 peer-checked:ring-blue-600">
                            <h3 class="font-bold text-gray-800">{{ $service->name }}</h3>
                            <p class="text-sm text-blue-600 font-semibold">Rp {{ number_format($service->price) }}</p>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between mt-10">
                <a href="{{ route('profile.edit') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-8 rounded-lg">Back</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-lg">Next</button>
            </div>
        </form>
    </div>
@endsection