<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Booking - CarWash</title>
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

    <div class="relative z-10">
        <header>
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <a href="{{ url('/') }}"><img src="{{ asset('LOGO.png') }}" alt="CarWash Logo" class="h-10 w-auto"></a>
                <div class="hidden md:flex items-center space-x-1 bg-slate-800/50 backdrop-blur-sm p-1 rounded-full">
                    <a href="{{ url('/') }}" class="text-white hover:bg-white/10 rounded-full font-semibold py-1.5 px-5">Home</a>
                    <a href="{{ route('booking.create') }}" class="text-gray-900 bg-white rounded-full font-semibold py-1.5 px-5">Booking</a>
                </div>
                <div class="flex items-center space-x-4 text-white">
                    @auth
                        <a href="{{ route('profile.edit') }}" class="font-semibold">{{ Auth::user()->name }}</a>
                        <a href="{{ route('profile.edit') }}">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" /></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold hover:underline">Login</a>
                        <a href="{{ route('register') }}" class="font-semibold bg-white text-blue-600 px-4 py-1.5 rounded-full hover:bg-gray-200">Register</a>
                    @endauth
                </div>
            </nav>
        </header>

        <main class="container mx-auto px-6 py-8"
              x-data="{
                step: 1,
                isLoading: false,
                selectedCar: '',
                selectedService: null,
                selectedDate: null,
                selectedTime: null,
                services: {{ json_encode($services) }},
                cars: {{ json_encode($cars) }},

                // Helper Functions
                getServiceName() { return this.selectedService ? this.selectedService.name : 'N/A'; },
                getServicePrice() { return this.selectedService ? this.selectedService.price : 0; },
                getCarName() { 
                    if (!this.selectedCar) return 'N/A';
                    const car = this.cars.find(c => c.id == this.selectedCar);
                    return car ? car.name : 'N/A';
                },
                formatCurrency(value) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
                },

                // Fungsi untuk mengirim data ke backend
                submitBooking() {
                    this.isLoading = true;
                    // ... (logika submitBooking dari jawaban sebelumnya)
                }
              }" x-cloak>

            <div class="w-full max-w-2xl mx-auto mb-12">
                <div class="flex items-center">
                    <div class="flex flex-col items-center text-center text-white">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center z-10" :class="step >= 1 ? 'bg-blue-600' : 'bg-white border-2 border-gray-400'">
                            <span x-show="step > 1">✓</span>
                            <span x-show="step <= 1">1</span>
                        </div>
                        <p class="mt-2 text-sm font-semibold">Langkah 1</p>
                        <p class="text-xs">Choose Service</p>
                    </div>
                    <div class="flex-auto border-t-2 transition-colors" :class="step >= 2 ? 'border-blue-600' : 'border-gray-400'"></div>
                    <div class="flex flex-col items-center text-center text-white">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center z-10" :class="step >= 2 ? 'bg-blue-600' : 'bg-white border-2 border-gray-400'">
                            <span x-show="step > 2">✓</span>
                            <span x-show="step <= 2">2</span>
                        </div>
                        <p class="mt-2 text-sm font-semibold">Langkah 2</p>
                        <p class="text-xs">Set a Schedule</p>
                    </div>
                    <div class="flex-auto border-t-2 transition-colors" :class="step >= 3 ? 'border-blue-600' : 'border-gray-400'"></div>
                    <div class="flex flex-col items-center text-center text-white">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center z-10" :class="step === 3 ? 'bg-blue-600' : 'bg-white border-2 border-gray-400'">
                            <span>3</span>
                        </div>
                        <p class="mt-2 text-sm font-semibold">Langkah 3</p>
                        <p class="text-xs">Start Cleaning</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 md:p-12 rounded-lg shadow-xl max-w-4xl mx-auto min-h-[450px]">
                <div x-show="step === 1" class="flex flex-col h-full">
                    <div class="flex-grow">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Choose Vehicle</h2>
                        <select x-model="selectedCar" class="block w-full max-w-md mx-auto p-3 border-gray-300 rounded-md shadow-sm">
                            <option value="" disabled>-- Select Your Vehicle --</option>
                            <template x-for="car in cars" :key="car.id">
                                <option :value="car.id" x-text="car.name"></option>
                            </template>
                        </select>
                        <h2 class="text-2xl font-bold text-gray-800 my-8 text-center">Choose Service</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <template x-for="service in services" :key="service.id">
                                <div @click="selectedService = service" class="p-4 border rounded-lg cursor-pointer text-center transition-all" :class="selectedService && selectedService.id === service.id ? 'border-blue-600 ring-2 ring-blue-600' : 'border-gray-300'">
                                    <h3 class="font-bold text-gray-800" x-text="service.name"></h3>
                                    <p class="text-sm text-blue-600 font-semibold" x-text="formatCurrency(service.price)"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div class="flex justify-between mt-10">
                        <button class="bg-gray-200 text-gray-400 font-semibold py-2 px-8 rounded-lg cursor-not-allowed">Back</button>
                        <button @click="step = 2" :disabled="!selectedCar || !selectedService" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-lg disabled:bg-gray-400">Next</button>
                    </div>
                </div>

                <div x-show="step === 2" x-cloak class="flex flex-col h-full">
                    <div class="flex-grow">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Choose Date</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-white rounded-lg text-gray-800">
                                <div class="flex justify-between items-center mb-4"><h4 class="font-bold text-lg">July 2025</h4></div>
                                <div class="grid grid-cols-7 gap-2 text-center text-sm text-gray-500 mb-2"><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span></div>
                                <div class="grid grid-cols-7 gap-2 text-center">
                                    <div></div>
                                    <template x-for="day in 31" :key="day">
                                        <div @click="selectedDate = `${day} Jul 2025`" class="p-2 hover:bg-blue-100 rounded-full cursor-pointer" :class="{'bg-blue-600 text-white font-bold': selectedDate === `${day} Jul 2025`}" x-text="day"></div>
                                    </template>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <template x-for="time in ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00', '17:00']">
                                    <div @click="selectedTime = time" class="p-3 border rounded-lg cursor-pointer text-center" :class="selectedTime === time ? 'border-blue-600 ring-2 ring-blue-600 font-bold' : 'border-gray-300'" x-text="time"></div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-10">
                        <button @click="step = 1" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-8 rounded-lg">Back</button>
                        <button @click="step = 3" :disabled="!selectedDate || !selectedTime" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-lg disabled:bg-gray-400">Next</button>
                    </div>
                </div>

                <div x-show="step === 3" x-cloak class="flex flex-col h-full">
                    <div class="flex-grow">
                        <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Confirmation</h2>
                        <div class="max-w-xl mx-auto border rounded-lg p-6 divide-y divide-gray-200">
                            <div class="flex justify-between items-center py-3">
                                <span class="text-gray-500">Service</span>
                                <span class="font-semibold text-gray-800" x-text="getServiceName()"></span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="text-gray-500">Schedule</span>
                                <span class="font-semibold text-gray-800" x-text="selectedDate ? `${selectedDate}, ${selectedTime}` : 'N/A'"></span>
                            </div>
                            <div class="pt-4 mt-4 border-t">
                                <p class="text-gray-500 text-sm mb-2">ITEM DETAIL</p>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold text-gray-800" x-text="getServiceName()"></p>
                                        <p class="text-sm text-gray-500" x-text="getCarName()"></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-800" x-text="formatCurrency(getServicePrice())"></p>
                                        <p class="text-sm text-gray-500">Rate</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center pt-4 mt-4 font-bold text-lg">
                                <span class="text-gray-900">Total</span>
                                <span class="text-blue-600" x-text="formatCurrency(getServicePrice())"></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-10 max-w-xl mx-auto">
                        <button @click="step = 2" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-8 rounded-lg">Back</button>
                        <button @click="submitBooking()" :disabled="isLoading" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-lg flex items-center disabled:bg-gray-400">
                            <span x-show="isLoading" class="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-3"></span>
                            <span x-text="isLoading ? 'Processing...' : 'Confirm'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <footer id="contact" class="bg-gray-800 text-gray-300">
        <div class="container mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12">

                <div class="lg:col-span-7">
                    <a href="#">
                        <img src="{{ asset('LOGO.png') }}" alt="CarWash Logo" class="h-14 w-auto mb-4">
                    </a>
                    <p class="text-gray-400 max-w-md">Jl. Denpasar Ceria, Kuta Selatan, Bali, Indonesia</p>
                    
                    <div class="mt-8 space-y-4">
                        <div class="flex items-start">
                            <span class="text-cyan-400 font-semibold w-16">Email</span>
                            <a href="mailto:carwas@gmail.com" class="hover:text-white">carwas@gmail.com</a>
                        </div>
                        <div class="flex items-start">
                            <span class="text-cyan-400 font-semibold w-16">Phone</span>
                            <a href="tel:+6282145706565" class="hover:text-white">+62 821-4570-6565</a>
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-3">
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-cyan-500 hover:bg-cyan-600 text-white rounded-full transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg></a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-cyan-500 hover:bg-cyan-600 text-white rounded-full transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg></a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-cyan-500 hover:bg-cyan-600 text-white rounded-full transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049 1.064.218 1.791.465 2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.345 2.525c.636-.247 1.363-.416 2.427-.465C9.793 2.013 10.147 2 12.315 2zM8.443 9.048a1.444 1.444 0 100 2.888 1.444 1.444 0 000-2.888zM12 6.75a5.25 5.25 0 100 10.5 5.25 5.25 0 000-10.5zM12 15a3 3 0 110-6 3 3 0 010 6z" clip-rule="evenodd" /></svg></a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-cyan-500 hover:bg-cyan-600 text-white rounded-full transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.784-1.75-1.75s.784-1.75 1.75-1.75 1.75.784 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-cyan-500 hover:bg-cyan-600 text-white rounded-full transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M21.582,6.186c-0.23-0.86-0.908-1.538-1.768-1.768C18.254,4,12,4,12,4S5.746,4,4.186,4.418 c-0.86,0.23-1.538,0.908-1.768,1.768C2,7.746,2,12,2,12s0,4.254,0.418,5.814c0.23,0.86,0.908,1.538,1.768,1.768 C5.746,20,12,20,12,20s6.254,0,7.814-0.418c0.861-0.23,1.538-0.908,1.768-1.768C22,16.254,22,12,22,12S22,7.746,21.582,6.186z M10,15.464V8.536L16,12L10,15.464z"/></svg></a>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <h3 class="text-2xl font-bold text-white">Join Our Newsletter</h3>
                    <p class="mt-4 text-gray-400">
                        Nibh venenatis donec tellus venenatis consectetur adipiscing scelerisque ut pulvinar id semper tortor.
                    </p>
                    <form action="#" method="POST" class="mt-8 space-y-4">
                        <div class="relative">
                            <input type="email" name="email" placeholder="Your email address" required class="w-full bg-gray-700 text-white placeholder-gray-400 border border-gray-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-cyan-500 pr-10">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                            </div>
                        </div>
                        <button type="submit" class="w-full flex items-center justify-center bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                            Subscribe Now
                            <svg class="w-5 h-5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" /></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="bg-black py-4">
            <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-sm">
                <p class="text-gray-400 mb-2 md:mb-0">&copy; Copyright 2025 CarWas. All Rights Reserved.</p>
                <p class="text-gray-300">CarWas, the cleaning car.</p>
            </div>
        </div>
    </footer>
</body>
</html>