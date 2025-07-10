<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CarWash')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body>
    <div class="relative min-h-screen">
        <div class="absolute inset-x-0 top-0 h-[450px] bg-cover bg-center" style="background-image: url('{{ asset('bookbg.png') }}');">
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <div class="relative z-10 flex flex-col min-h-screen">
            <header>
                <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                    <a href="{{ url('/') }}"><img src="{{ asset('LOGO.png') }}" alt="CarWash Logo" class="h-10 w-auto"></a>
                    <div class="hidden md:flex items-center space-x-1 bg-slate-800/50 backdrop-blur-sm p-1 rounded-full">
                        <a href="{{ url('/') }}" class="text-white hover:bg-white/10 rounded-full font-semibold py-1.5 px-5">Home</a>
                        <a href="{{ route('booking.step1.create') }}" class="text-gray-900 bg-white rounded-full font-semibold py-1.5 px-5">Booking</a>
                    </div>
                    <div class="flex items-center space-x-4 text-white">
                        @auth
                            <a href="{{ route('profile.edit') }}" class="font-semibold">{{ Auth::user()->name }}</a>
                            <form method="POST" action="{{ route('logout') }}"> @csrf <button type="submit" title="Logout">...</button> </form>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold hover:underline">Login</a>
                            <a href="{{ route('register') }}" class="font-semibold bg-white text-blue-600 px-4 py-1.5 rounded-full">Register</a>
                        @endauth
                    </div>
                </nav>
            </header>

            <main class="container mx-auto px-6 py-8 flex-grow">
                @yield('content')
            </main>

            <footer class="bg-gray-800 text-gray-300">
                </footer>
        </div>
    </div>
</body>
@stack('scripts')</html>