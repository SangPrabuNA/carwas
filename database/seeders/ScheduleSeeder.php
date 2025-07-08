<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Car;
use App\Models\Service;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat satu user customer
        $customer = User::create([
            'name' => 'Contoh Customer',
            'email' => 'customer@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Testing',
            'role' => 'user'
        ]);

        // Buat satu mobil untuk customer tersebut
        $car = $customer->cars()->create([
            'brand' => 'Toyota',
            'model' => 'Avanza',
            'plate_number' => 'DK 1234 TEST'
        ]);

        // Buat satu jadwal booking menggunakan user, mobil, dan service pertama
        Schedule::create([
            'user_id' => $customer->id,
            'car_id' => $car->id,
            'service_id' => Service::first()->id, // Ambil service pertama
            'tanggal_masuk' => now(),
            'jam_masuk' => '10:00:00',
            'tanggal_selesai' => now(),
            'jam_keluar' => '11:00:00',
            'status' => 'Confirmed'
        ]);
    }
}