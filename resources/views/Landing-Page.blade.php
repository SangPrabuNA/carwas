<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarWash - Where Your Car's Shine Takes Flight</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        /* Menambahkan font Poppins sebagai font utama */
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">

    <header class="bg-black">
        <nav class="container mx-auto px-6 py-3 relative flex justify-between items-center">
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('LOGO.png') }}" alt="CarWash Logo" class="h-10 w-auto">
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-1 bg-slate-800/50 backdrop-blur-sm p-1 rounded-full">
                <a href="{{ url('/') }}" class="text-gray-900 bg-white rounded-full font-semibold py-1.5 px-5 transition-colors">Home</a>
                <a href="{{ route('booking.create') }}" class="text-white hover:bg-white/10 rounded-full font-semibold py-1.5 px-5 transition-colors">Booking</a>
            </div>

            <div class="hidden md:flex items-center">
                @auth
                    <div class="flex items-center space-x-3 text-white">
                        <a href="{{ route('profile.edit') }}" class="font-semibold">{{ Auth::user()->name }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" title="Logout">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H3" /></svg>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center bg-gray-800 rounded-md p-1">
                        <a href="{{ route('register') }}" class="py-1 px-4 text-sm font-semibold bg-white text-gray-900 rounded-md">Register</a>
                        <a href="{{ route('login') }}" class="py-1 px-4 text-sm font-semibold text-white hover:bg-gray-700 rounded-md transition-colors">Login</a>
                    </div>
                @endguest
            </div>

            <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </nav>
    
        <div id="mobile-menu" class="hidden md:hidden bg-gray-900 border-t border-gray-700">
            <a href="#" class="block py-3 px-6 text-white font-semibold hover:bg-gray-800">Home</a>
            <a href="#booking" class="block py-3 px-6 text-white hover:bg-gray-800">Booking</a>
            <a href="#" class="block py-3 px-6 text-white hover:bg-gray-800 border-t border-gray-700 mt-2 pt-4">Register</a>
            <a href="#" class="block py-3 px-6 text-white hover:bg-gray-800">Login</a>
        </div>
    </header> 

    <main>
        <section id="home" class="relative min-h-screen flex items-center bg-cover bg-center" style="background-image: url('{{ asset('background-herosection.png') }}');">
            <div class="absolute inset-0 bg-black opacity-60"></div>
            <div class="container mx-auto px-6 text-left relative z-10">
                <div class="md:w-1/2">
                    <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">CarWash Where Your Car's Shine Takes Flight</h1>
                    <p class="text-lg md:text-xl text-gray-300 mb-8">Premium cleaning and hygiene with our jet wash company. Your car deserves the best treatment.</p>
                    <a href="#booking" class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 px-8 rounded-lg text-lg transition-colors">
                        book now
                    </a>
                </div>
            </div>
        </section>
        <section id="about" class="bg-white py-20 lg:py-24">
            <div class="container mx-auto px-6">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <div class="text-left">
                        <p class="text-blue-600 font-semibold uppercase tracking-wider text-sm mb-2">ABOUT US</p>
                        <h2 class="text-4xl lg:text-5xl font-bold text-black leading-tight mb-5">
                            Clean and Higiene With Jet Wash The Cleaning Company
                        </h2>
                        <p class="text-gray-900 leading-relaxed">
                            We're a destination for car enthusiasts and everyday drivers alike. Step into our world of premium car care and experience the difference that attention to detail and cutting-edge technology can make.
                        </p>
                    </div>
                    
                    <div>
                        <img src="{{ asset('aboutus-image.png') }}" alt="Car washing process" class="rounded-lg shadow-2xl w-full h-auto">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-20">
                    <div class="bg-gray-800 p-6 rounded-lg flex items-center hover:bg-gray-700 transition-colors duration-300">
                        <div class="bg-gray-900 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V8.25a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 8.25v7.5A2.25 2.25 0 0 0 6.75 18Z" />
                            </svg>
                        </div>
                        <div class="ml-5 flex-grow">
                            <h3 class="font-bold text-lg text-white">New Technology</h3>
                        </div>
                        <svg class="w-6 h-6 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </div>

                    <div class="bg-gray-800 p-6 rounded-lg flex items-center hover:bg-gray-700 transition-colors duration-300">
                        <div class="bg-gray-900 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div class="ml-5 flex-grow">
                            <h3 class="font-bold text-lg text-white">Fast Service</h3>
                        </div>
                        <svg class="w-6 h-6 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </div>

                    <div class="bg-gray-800 p-6 rounded-lg flex items-center hover:bg-gray-700 transition-colors duration-300">
                        <div class="bg-gray-900 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.17 48.17 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>
                        </div>
                        <div class="ml-5 flex-grow">
                            <h3 class="font-bold text-lg text-white">Top Service</h3>
                        </div>
                        <svg class="w-6 h-6 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </div>
                </div>

            </div>
        </section>
        <section id="services" class="bg-white py-20 lg:py-24">
            <div class="container mx-auto px-6">

                <div class="text-center max-w-3xl mx-auto mb-16">
                    <p class="text-blue-600 font-semibold uppercase tracking-wider text-sm mb-2">OUR SERVICES</p>
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-4">
                        All-in-One Cleaning Solutions CarWash
                    </h2>
                    <p class="text-gray-500 leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>

                <div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                        <div class="text-left group">
                            <div class="overflow-hidden rounded-lg">
                                <img src="{{ asset('paket1.png') }}" alt="Paket Cuci Mobil Biasa" class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="pt-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-1">Packet 1 (99K/ 1 Jam)</h3>
                                <p class="text-gray-500">Cuci mobil biasa</p>
                            </div>
                        </div>

                        <div class="text-left group">
                            <div class="overflow-hidden rounded-lg">
                                <img src="{{ asset('paket2.png') }}" alt="Paket Cuci Mobil dan Detailing Body" class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="pt-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-1">Packet 2 (499K/ 2 Jam)</h3>
                                <p class="text-gray-500">Cuci mobil + detailing body</p>
                            </div>
                        </div>

                        <div class="text-left group">
                            <div class="overflow-hidden rounded-lg">
                                <img src="{{ asset('paket3.png') }}" alt="Paket Cuci Mobil, Detailing Body dan Interior" class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="pt-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-1">Packet 3 (799K/ 3 Jam)</h3>
                                <p class="text-gray-500">Cuci Mobil + Detailing Body dan Interior</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-16 flex justify-center">
                        <div class="text-left group lg:w-2/5 md:w-3/5">
                            <div class="overflow-hidden rounded-lg">
                                <img src="{{ asset('paketcomplete.png') }}" alt="Paket Lengkap CarWash" class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="pt-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-1">Complete Packet (4999K/ 5 Jam)</h3>
                                <p class="text-gray-500">Faucibus in ornare quam viverra orci sagittis. Lectus sit amet est placerat in. Quis commodo odio aenean sed.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="booking" class="relative bg-cover bg-center bg-fixed py-20 lg:py-24" style="background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.85)), url('{{ asset('bookbg.png') }}');">
            <div class="container mx-auto px-6 relative z-10">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <p class="text-cyan-400 font-semibold uppercase tracking-wider text-sm mb-2">STEPS</p>
                    <h2 class="text-4xl lg:text-5xl font-bold text-white leading-tight">
                        Book in 3 Easy Steps
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-slate-800/50 rounded-lg p-8 relative">
                        <div class="absolute top-0 left-0 -mt-4 -ml-4 w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">1</div>
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-white">Choose a Service</h3>
                            <svg class="w-8 h-8 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        </div>
                        <p class="text-slate-300 text-sm">Id et diam diam sem donec duis id feugiat tempus leo ut ac amet cras ac sapien.</p>
                    </div>
                    <div class="bg-slate-800/50 rounded-lg p-8 relative">
                        <div class="absolute top-0 left-0 -mt-4 -ml-4 w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">2</div>
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-white">Schedule Date</h3>
                            <svg class="w-8 h-8 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0h18M-4.5 12h22.5" /></svg>
                        </div>
                        <p class="text-slate-300 text-sm">Id et diam diam sem donec duis id feugiat tempus leo ut ac amet cras ac sapien.</p>
                    </div>
                    <div class="bg-slate-800/50 rounded-lg p-8 relative">
                        <div class="absolute top-0 left-0 -mt-4 -ml-4 w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">3</div>
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-white">Start Cleaning</h3>
                            <svg class="w-8 h-8 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5v-1.875a3.375 3.375 0 0 1 3.375-3.375h9.75a3.375 3.375 0 0 1 3.375 3.375v1.875m-17.25 4.5h16.5M5.25 6.042a1.502 1.502 0 0 1 1.06.44l3.187 3.188a1.5 1.5 0 0 0 2.121 0l3.188-3.188a1.502 1.502 0 0 1 1.06-.44M5.25 6.042V3.375c0-.621.504-1.125 1.125-1.125h11.25c.621 0 1.125.504 1.125 1.125v2.667m-13.5 0v2.667a1.5 1.5 0 0 0 1.5 1.5h10.5a1.5 1.5 0 0 0 1.5-1.5V6.042" /></svg>
                        </div>
                        <p class="text-slate-300 text-sm">Id et diam diam sem donec duis id feugiat tempus leo ut ac amet cras ac sapien.</p>
                    </div>
                </div>
                <div class="mt-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <p class="text-cyan-400 font-semibold uppercase tracking-wider text-sm mb-2">QUICK SERVICES</p>
                        <h3 class="text-3xl lg:text-4xl font-bold text-white leading-tight mb-4">Book Schedule</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Id et diam diam sem donec. Duis id feugiat tempus, leo ut ac amet cras. Ac sapien enim platea mauris. Vel non aliquam mattis aliquet fames mauris. Libero gravida dictum mi, maecenas convallis.
                        </p>
                        <a href="#" class="inline-flex items-center mt-8 bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 px-6 rounded-lg transition-colors shadow-lg shadow-cyan-500/30">
                            Book Now
                            <svg class="w-5 h-5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                    <div class="bg-white rounded-lg p-6 shadow-2xl text-gray-800">
                        <div class="flex justify-between items-center mb-4">
                            <button class="p-2 rounded-full hover:bg-gray-100"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg></button>
                            <h4 class="font-bold text-lg">June 2025</h4>
                            <button class="p-2 rounded-full hover:bg-gray-100"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg></button>
                        </div>
                        <div class="grid grid-cols-7 gap-2 text-center text-sm text-gray-500 mb-2"><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span></div>
                        <div class="grid grid-cols-7 gap-2 text-center">
                            <div class="text-gray-400">26</div><div class="text-gray-400">27</div><div class="text-gray-400">28</div><div class="text-gray-400">29</div><div class="text-gray-400">30</div><div class="text-gray-400">31</div><div>1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div><div class="bg-blue-600 text-white rounded-full p-2 cursor-pointer">7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div><div>13</div><div>14</div><div>15</div><div>16</div><div>17</div><div>18</div><div>19</div><div>20</div><div>21</div><div>22</div><div>23</div><div>24</div><div>25</div><div>26</div><div class="font-bold text-blue-700">27</div><div>28</div><div>29</div><div>30</div><div class="text-gray-400">1</div><div class="text-gray-400">2</div><div class="text-gray-400">3</div><div class="text-gray-400">4</div><div class="text-gray-400">5</div><div class="text-gray-400">6</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="testimonials" class="bg-white py-20 lg:py-24">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                    
                    <div class="relative">
                        <img src="{{ asset('mapsdummy.jpg') }}" alt="Area Layanan Peta Bali" class="rounded-lg shadow-lg w-full h-auto">
                        <div class="absolute bottom-6 left-6 bg-slate-800/80 backdrop-blur-sm p-4 rounded-lg shadow-2xl flex items-center space-x-4">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/1024px-Google_%22G%22_logo.svg.png" alt="Google Logo" class="w-8 h-8">
                            <div>
                                <p class="text-white font-semibold">Overall Rating Google</p>
                                <div class="flex items-center">
                                    <span class="text-yellow-400 font-bold mr-2">4.9</span>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="text-gray-300 text-sm ml-2">(5.1k Reviews)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-left text-gray-900">
                        <p class="text-blue-600 font-semibold uppercase tracking-wider text-sm mb-2">TESTIMONIALS</p>
                        <h2 class="text-4xl lg:text-5xl font-bold leading-tight mb-4">
                            What Our Clients Say
                        </h2>
                        <p class="text-gray-500 leading-relaxed mb-10">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>

                        <div class="border-l-4 border-gray-200 pl-6 mb-8">
                            <p class="text-lg italic text-gray-700 mb-6">"I've been a loyal customer of JetWash for years, and their attention to detail never fails to impress me. My car always looks brand new after a visit!"</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div> <div>
                                        <p class="font-bold text-gray-800">Zoe Anderson</p>
                                        <p class="text-sm text-gray-500">General Manager - Fresno</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <span class="font-bold text-yellow-500">4.9</span>
                                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="border-l-4 border-gray-200 pl-6">
                            <p class="text-lg italic text-gray-700 mb-6">"JetWash's mobile wash service is a game-changer for my busy schedule. I love that they can come to me and leave my car spotless while I focus on other things."</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div> <div>
                                        <p class="font-bold text-gray-800">Zoe Anderson</p>
                                        <p class="text-sm text-gray-500">General Manager - Fresno</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <span class="font-bold text-yellow-500">4.9</span>
                                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="gallery" class="bg-white py-20 lg:py-24">
            <div class="container mx-auto px-6">                
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-4">
                        Gallery
                    </h2>
                    <p class="text-gray-500 leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
                <div class="relative">
                    <div class="swiper gallery-swiper">
                        <div class="swiper-wrapper">
                            
                            @foreach ($galleryImages as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset($image['url']) }}" alt="{{ $image['alt'] }}" class="w-full h-auto object-cover rounded-lg shadow-lg">
                                </div>
                            @endforeach

                        </div>
                    </div>                   
                    <div class="swiper-button-prev-unique absolute top-1/2 -translate-y-1/2 left-[-1rem] z-10 cursor-pointer bg-white hover:bg-gray-100 p-3 rounded-full shadow-lg transition-colors">
                        <svg class="w-6 h-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
                    </div>
                    <div class="swiper-button-next-unique absolute top-1/2 -translate-y-1/2 right-[-1rem] z-10 cursor-pointer bg-white hover:bg-gray-100 p-3 rounded-full shadow-lg transition-colors">
                        <svg class="w-6 h-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                    </div>
                </div>               
            </div>
        </section>
    </main>

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
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Opsional: Tutup menu jika link di-klik
        const mobileLinks = mobileMenu.getElementsByTagName('a');
        for (let link of mobileLinks) {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        }
    </script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.gallery-swiper', {
            // Opsi dasar
            loop: true,
            spaceBetween: 20, // Mengurangi jarak antar slide
            grabCursor: true,
            
            // Menampilkan berapa slide berdasarkan ukuran layar
            slidesPerView: 1, // Default untuk mobile
            breakpoints: {
                // saat lebar layar >= 768px (tablet)
                768: {
                    slidesPerView: 3, // Tampilkan 2 slide
                    spaceBetween: 20,
                },
            },

            // Menonaktifkan centered slides untuk layout ini
            centeredSlides: false,

            // Menghubungkan tombol navigasi panah
            navigation: {
                nextEl: '.swiper-button-next-unique',
                prevEl: '.swiper-button-prev-unique',
            },
        });
    </script>

</body>
</html>