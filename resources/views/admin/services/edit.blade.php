@extends('layouts.admin')
@section('title', 'Edit Service')
@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Service</h1>

    <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
                <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">{{ old('description', $service->description) }}</textarea>
            </div>
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700">Waktu Pengerjaan (dalam jam)</label>
                <input type="number" name="duration" id="duration" value="{{ old('duration', $service->duration) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="price" id="price" value="{{ old('price', $service->price) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.services.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Simpan Perubahan</button>
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Layanan Baru (Opsional)</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full ...">
                @if ($service->image)
                    <p class="text-xs text-gray-500 mt-2">Gambar saat ini: <img src="{{ asset('storage/' . $service->image) }}" class="inline-block h-10 w-auto ml-2"></p>
                @endif
            </div>
        </form>
    </div>
@endsection