@extends('layouts.admin')
@section('title', 'Edit Worker')
@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Worker</h1>
    <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl">
        <form action="{{ route('admin.workers.update', $worker) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium">Nama Pekerja</label>
                <input type="text" name="name" id="name" value="{{ old('name', $worker->name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
            </div>
            <div>
                <label for="address" class="block text-sm font-medium">Alamat</label>
                <textarea name="address" id="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">{{ old('address', $worker->address) }}</textarea>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.workers.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection