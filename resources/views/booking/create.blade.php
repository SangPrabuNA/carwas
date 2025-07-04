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
    <div class="absolute inset-x-0 top-0 h-[300px] bg-cover bg-center" style="background-image: url('{{ asset('bookbg.png') }}');">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>
    <div class="relative z-10">
        <header>
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
                getServiceName() { return this.selectedService ? this.selectedService.name : 'Not Selected'; },
                getServicePrice() { return this.selectedService ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(this.selectedService.price) : 'Rp 0'; },
                
                // Method untuk memformat tanggal ke YYYY-MM-DD
                formatDateForBackend(dateString) {
                    if (!dateString) return null;
                    const date = new Date(dateString);
                    const year = date.getFullYear();
                    const month = (date.getMonth() + 1).toString().padStart(2, '0');
                    const day = date.getDate().toString().padStart(2, '0');
                    return `${year}-${month}-${day}`;
                },

                // Method untuk mengirim data ke backend
                submitBooking() {
                    this.isLoading = true;

                    // Data yang akan dikirim, sesuaikan dengan backend Anda
                    const bookingData = {
                        nama: this.getServiceName(),
                        tanggal_masuk: this.formatDateForBackend(this.selectedDate),
                        jam_masuk: this.selectedTime,
                        tanggal_selesai: this.formatDateForBackend(this.selectedDate), // Asumsi selesai di hari yang sama
                        jam_keluar: '17:00' // Asumsi jam keluar
                    };
                    
                    fetch('/api/schedules', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                        },
                        body: JSON.stringify(bookingData)
                    })
                    .then(response => {
                        if (!response.ok) {
                            // Jika ada error validasi atau server
                            throw new Error('Booking failed!');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Jika berhasil
                        alert('Booking successful! Your schedule has been saved.');
                        window.location.href = '/profile'; // Redirect ke halaman profil
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
                }
              }" x-cloak>

            <div class="bg-white p-8 md:p-12 rounded-lg shadow-xl max-w-4xl mx-auto">
                <div x-show="step === 3" x-cloak>
                    <div class="flex justify-between mt-10">
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
    
    <footer class="bg-gray-800 text-gray-300">
       </footer>
</body>
</html>