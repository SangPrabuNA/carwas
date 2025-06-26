<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CarWash</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white">

    <div class="min-h-screen grid lg:grid-cols-2">
        
        <div class="hidden lg:flex relative items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('register-bg.png') }}');">
            <div class="absolute inset-0"></div>
            
            <div class="relative z-10">
                <img src="{{ asset('LOGO.png') }}" alt="CarWash Logo" class="w-auto h-24">
            </div>

            <a href="{{ url('/') }}" class="absolute bottom-8 left-8 z-10 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-6 rounded-lg transition-colors">
                Back
            </a>
        </div>

        <div class="flex items-center justify-center p-8 sm:p-12">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-bold text-gray-900">Hello Again!</h2>
                <p class="text-gray-500 mt-1 mb-8">Welcome Back</p>

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                           <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" /><path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" /></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                     @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" /></svg>
                        </div>
                        <input type="password" name="password" placeholder="Password" required class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors">
                        Login
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <a href="#" class="text-sm text-blue-500 hover:underline"> Forgot Password?
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>