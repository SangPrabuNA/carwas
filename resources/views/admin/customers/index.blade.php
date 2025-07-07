@extends('layouts.admin')

@section('title', 'Customers')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Customers</h1>
        <div class="relative">
            <input type="text" placeholder="Cari customer..." class="pl-10 pr-4 py-2 border rounded-lg">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">...</svg>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3">ID Customer</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">No Telepon</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Kendaraan</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 font-medium">{{ $customer->id }}</td>
                            <td class="p-3">{{ $customer->name }}</td>
                            <td class="p-3">{{ $customer->phone }}</td>
                            <td class="p-3">{{ $customer->email }}</td>
                            <td class="p-3">{{ $customer->cars_count }}</td>
                            <td class="p-3 flex items-center gap-x-2">
                                <a href="{{ route('admin.customers.show', $customer) }}" class="bg-blue-500 text-white px-4 py-1 rounded-md text-xs hover:bg-blue-600">Detail</a>
                                <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus customer ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded-md text-xs hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-gray-500">Tidak ada data customer.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection