@extends('layouts.admin')

@section('title', 'Add New Service')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Add New Service</h1>

    <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl">
        <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3"></textarea>
            </div>
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700">Waktu Pengerjaan (dalam jam)</label>
                <input type="number" name="duration" id="duration" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="price" id="price" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.services.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Simpan</button>
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Layanan</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full ...">
            </div>
        </form>
    </div>
@endsection