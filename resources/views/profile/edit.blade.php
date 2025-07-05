<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - CarWash</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; /* bg-gray-100 */ }
    </style>
</head>
<body>

<div class="relative min-h-screen">
    <div class="absolute inset-x-0 top-0 h-[400px] bg-cover bg-center" style="background-image: url('{{ asset('background-herosection.png') }}');">
         <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <div class="relative z-10">
        
        <header>
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('LOGO.png') }}" alt="CarWash Logo" class="h-10 w-auto">
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-1 bg-slate-800/50 backdrop-blur-sm p-1 rounded-full">
                    <a href="{{ url('/') }}" class="text-gray-900 bg-white rounded-full font-semibold py-1.5 px-5 transition-colors">Home</a>
                    <a href="#" class="text-white hover:bg-white/10 rounded-full font-semibold py-1.5 px-5 transition-colors">Booking</a>
                </div>

                <div class="flex items-center space-x-4 text-white">
                    <a href="{{ route('profile.edit') }}" class="font-semibold">{{ Auth::user()->name }}</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Logout">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H3" /></svg>
                        </button>
                    </form>
                </div>
            </nav>
        </header>

        <main class="container mx-auto px-6 py-8">
            <div class="bg-white p-8 rounded-lg shadow-xl">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-300 rounded-full mr-4 flex-shrink-0"></div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                            <p class="text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <button id="edit-button" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg mt-4 sm:mt-0 transition-colors">Edit</button>
                </div>
                <hr>
                <form id="profile-form" class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" disabled class="profile-input mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm p-3 transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" disabled class="profile-input mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm p-3 transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" value="{{ $user->address }}" disabled class="profile-input mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm p-3 transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" value="********" disabled class="profile-input mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm p-3 transition-colors">
                    </div>
                    <div class="md:col-span-2 text-right hidden" id="form-buttons">
                        <button type="button" id="cancel-button" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg mr-2">Cancel</button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Save Changes</button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-xl mt-10">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">My Car</h2>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Add</button>
                </div>
                
                <div class="space-y-6">
                    @forelse ($cars as $car)
                        <div class="flex items-center justify-between p-4 border rounded-lg">
                            <div class="flex items-center">
                                <img src="{{ $car->image }}" alt="{{ $car->brand }}" class="w-24 h-16 object-cover rounded-md mr-6">
                                <div>
                                    <p class="font-bold text-lg text-gray-800">{{ $car->plate_number }}</p>
                                    <p class="text-gray-600">{{ $car->brand }} <span class="font-medium">{{ $car->model }}</span></p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-blue-600">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                            </button>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">You haven't added any cars yet.</p>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
    
    <footer id="contact" class="bg-gray-800 text-gray-300">
       </footer>

    <script>
        // Kode JavaScript dari jawaban sebelumnya tetap di sini
    </script>
</body>
</html>