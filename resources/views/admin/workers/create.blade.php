@extends('layouts.admin')
@section('title', 'Add Worker')
@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Add New Worker</h1>
    <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl">
        <form action="{{ route('admin.workers.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium">Nama Pekerja</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
            </div>
            <div>
                <label for="address" class="block text-sm font-medium">Alamat</label>
                <textarea name="address" id="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3"></textarea>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.workers.index') }}" class="bg-gray-200 py-2 px-6 rounded-lg">Batal</a>
                <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
@endsection