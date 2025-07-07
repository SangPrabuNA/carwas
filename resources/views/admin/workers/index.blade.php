@extends('layouts.admin')
@section('title', 'Workers')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Workers</h1>
        <a href="{{ route('admin.workers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">
            Tambah Pekerja
        </a>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3">ID Pekerja</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Alamat</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($workers as $worker)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 font-medium">{{ $worker->id }}</td>
                        <td class="p-3">{{ $worker->name }}</td>
                        <td class="p-3">{{ $worker->address }}</td>
                        <td class="p-3 flex items-center gap-x-2">
                            <a href="{{ route('admin.workers.edit', $worker) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-md text-xs">Edit</a>
                            <form action="{{ route('admin.workers.destroy', $worker) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center p-4">Tidak ada data pekerja.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection