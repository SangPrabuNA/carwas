<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - CarWash</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-800 text-white flex flex-col">
            <div class="p-6 text-center">
                <div class="w-20 h-20 bg-gray-500 rounded-full mx-auto mb-4"></div>
                <h2 class="font-bold text-xl">{{ Auth::user()->name }}</h2>
                <p class="text-sm text-gray-400">{{ Auth::user()->role }}</p>
            </div>
            <nav class="flex-grow px-4">
                <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors
                        {{ request()->routeIs('admin.dashboard') ? 'bg-slate-900 text-white' : 'text-gray-400 hover:bg-slate-700 hover:text-white' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Jadwal Booking</span>
                </a>

                <a href="{{ route('admin.customers.index') }}" 
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors
                        {{ request()->routeIs('admin.customers.*') ? 'bg-slate-900 text-white' : 'text-gray-400 hover:bg-slate-700 hover:text-white' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Customer</span>
                </a>

                <a href="{{ route('admin.services.index') }}" 
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors
                        {{ request()->routeIs('admin.services.*') ? 'bg-slate-900 text-white' : 'text-gray-400 hover:bg-slate-700 hover:text-white' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Services</span>
                </a>

                <a href="{{ route('admin.workers.index') }}" 
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors
                            {{ request()->routeIs('admin.workers.*') ? 'bg-slate-900 text-white' : 'text-gray-400 hover:bg-slate-700 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Workers</span>
                </a>
                
                {{-- Anda bisa menambahkan link lain dengan pola yang sama --}}
                
            </nav>
            <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-slate-700 text-left">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H3" />
                        </svg>
                        <span>Log Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>