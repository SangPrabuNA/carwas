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
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('LOGO.png') }}" alt="CarWash Logo" class="h-10 w-auto">
            </a>
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="#booking" class="text-gray-600 hover:text-blue-600">Booking</a>
            </div>
            <div class="flex items-center space-x-3">
                <span class="font-semibold text-gray-700">{{ $user->name }}</span>
                <div class="w-10 h-10 bg-gray-300 rounded-full"></div> </div>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-12">
        <div class="bg-white p-8 rounded-lg shadow-lg">
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

        <div class="bg-white p-8 rounded-lg shadow-lg mt-10">
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

    <footer id="contact" class="bg-gray-800 text-gray-300 mt-20">
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
        const editButton = document.getElementById('edit-button');
        const formButtons = document.getElementById('form-buttons');
        const cancelButton = document.getElementById('cancel-button');
        const profileInputs = document.querySelectorAll('.profile-input');

        function toggleFormState(isEditing) {
            profileInputs.forEach(input => {
                input.disabled = !isEditing;
                input.classList.toggle('bg-gray-100', !isEditing);
                input.classList.toggle('bg-white', isEditing);
            });
            formButtons.classList.toggle('hidden', !isEditing);
            editButton.classList.toggle('hidden', isEditing);
        }

        editButton.addEventListener('click', () => {
            toggleFormState(true);
        });

        cancelButton.addEventListener('click', () => {
            toggleFormState(false);
            // Anda bisa tambahkan logika untuk mereset nilai form ke awal jika perlu
            document.getElementById('profile-form').reset();
        });
    </script>
</body>
</html>