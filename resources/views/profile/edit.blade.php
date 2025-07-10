<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - CarWash</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; /* bg-gray-100 */ }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body x-data="{ addCarModalOpen: false }">

<div class="relative min-h-screen">
    <div class="absolute inset-x-0 top-0 h-[400px] bg-cover bg-center" style="background-image: url('{{ asset('bookbg.png') }}');">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <div class="relative z-10">
        
        <header>
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <a href="{{ url('/') }}"><img src="{{ asset('LOGO.png') }}" alt="CarWash Logo" class="h-10 w-auto"></a>
                <div class="hidden md:flex items-center space-x-1 bg-slate-800/50 backdrop-blur-sm p-1 rounded-full">
                    <a href="{{ url('/') }}" class="text-white hover:bg-white/10 rounded-full font-semibold py-1.5 px-5">Home</a>
                    <a href="{{ route('booking.step1.create') }}" class="text-white hover:bg-white/10 rounded-full font-semibold py-1.5 px-5">Booking</a>
                </div>
                <div class="flex items-center space-x-4 text-white">
                    @auth
                        <a href="{{ route('profile.edit') }}" class="font-semibold">{{ Auth::user()->name }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" title="Logout">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H3" /></svg>
                            </button>
                        </form>
                    @endauth
                </div>
            </nav>
        </header>

        <main class="container mx-auto px-6 py-8">
            @if (session('status'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Error!</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-8 rounded-lg shadow-xl">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8">
                    <div class="flex items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                            <p class="text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
                <hr>
                <form action="{{ route('profile.update') }}" method="POST" class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" value="{{ old('address', $user->address) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">New Password (optional)</label>
                        <input type="password" name="password" placeholder="Leave blank to keep current" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm your new password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
                    </div>
                    <div class="md:col-span-2 text-right">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Save Changes</button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-xl mt-10">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">My Car</h2>
                    <button @click="addCarModalOpen = true" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Add</button>
                </div>
                
                <div class="space-y-6">
                    @forelse ($user->cars as $car)
                        <div class="flex items-center justify-between p-4 border rounded-lg">
                            <div class="flex items-center">
                                <img src="{{ $car->image ? asset('storage/' . $car->image) : 'https://via.placeholder.com/96x64.png?text=No+Image' }}" alt="{{ $car->brand }}" class="w-24 h-16 object-cover rounded-md mr-6 bg-gray-100">
                                <div>
                                    <p class="font-bold text-lg text-gray-800">{{ $car->plate_number }}</p>
                                    <p class="text-gray-600">{{ $car->brand }} <span class="font-medium">{{ $car->model }}</span></p>
                                </div>
                            </div>
                            
                            <a href="{{ route('cars.edit', $car) }}" class="text-gray-400 hover:text-blue-600" title="Edit Car">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">You haven't added any cars yet.</p>
                    @endforelse
                </div>
            <div class="mt-8 ">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">My Bookings</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-3">Service</th>
                                    <th class="p-3">Vehicle</th>
                                    <th class="p-3">Schedule</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3 font-medium">{{ $booking->service?->name ?? 'N/A' }}</td>
                                        <td class="p-3">{{ $booking->car?->name ?? 'N/A' }}</td>
                                        <td class="p-3">
                                            {{ $booking->tanggal_masuk->format('d M Y') }}
                                            <span class="text-gray-500">{{ date('H:i', strtotime($booking->jam_masuk)) }}</span>
                                        </td>
                                        <td class="p-3">
                                            <a href="{{ route('booking.show', $booking) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
                                                Detail
                                            </a>
                                        </td>
                                        <td class="p-3">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                @if($booking->status == 'Pending') bg-yellow-100 text-yellow-800 @endif
                                                @if($booking->status == 'Confirmed') bg-blue-100 text-blue-800 @endif
                                                @if($booking->status == 'Finished') bg-green-100 text-green-800 @endif
                                                @if($booking->status == 'Canceled') bg-red-100 text-red-800 @endif
                                            ">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-4 text-gray-500">You have no booking history.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </main>
    </div>
    
    
    <div x-show="addCarModalOpen" x-transition class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4" x-cloak>
        <div @click.outside="addCarModalOpen = false" class="bg-white w-full max-w-lg p-8 rounded-lg">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Add New Car</h3>
            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="plate_number" class="block text-sm font-medium text-gray-700">Plate Number</label>
                    <input type="text" id="plate_number" name="plate_number" value="{{ old('plate_number') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
                    @error('plate_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
                    @error('brand')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                    <input type="text" id="model" name="model" value="{{ old('model') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
                    @error('model')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Car Photo</label>
                    <input type="file" id="image" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end pt-6 space-x-3">
                    <button type="button" @click="addCarModalOpen = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg">Cancel</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Save Car</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-gray-800 text-gray-300">
       </footer>
</body>
</html>