@extends('layouts.admin')

@section('title', 'Services')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Services</h1>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Cari services..." class="pl-10 pr-4 py-2 border rounded-lg">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" ...></svg>
                </div>
            </div>
            <a href="{{ route('admin.services.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">
                Tambah Services
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3">ID</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Deskripsi</th>
                        <th class="p-3">Waktu Pengerjaan (Jam)</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 font-medium">{{ $service->id }}</td>
                            <td class="p-3">{{ $service->name }}</td>
                            <td class="p-3 max-w-sm">{{ $service->description ?? 'N/A' }}</td>
                            <td class="p-3">{{ $service->duration }}</td>
                            <td class="p-3">{{ number_format($service->price, 0, ',', '.') }}</td>
                            <td class="p-3 flex items-center gap-x-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="bg-yellow-400 text-white px-3 py-1 rounded-md text-xs hover:bg-yellow-500">Edit</a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus layanan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-gray-500">Tidak ada data layanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection