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
                <h2 class="font-bold text-xl">Admin</h2>
                <p class="text-sm text-gray-400">Tralalero Tralala</p>
            </div>
            <nav class="flex-grow px-4">
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-slate-900 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">...</svg>
                    <span>Jadwal Booking</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-slate-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">...</svg>
                    <span>Customer</span>
                </a>
                </nav>
            <div class="p-4 border-t border-slate-700">
                 <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-slate-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">...</svg>
                    <span>Log Out</span>
                </a>
            </div>
        </aside>

        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>