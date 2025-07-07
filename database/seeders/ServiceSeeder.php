<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create(['name' => 'Packet 1', 'price' => 99000, 'duration' => 1]);
        Service::create(['name' => 'Packet 2', 'price' => 499000, 'duration' => 2]);
        Service::create(['name' => 'Packet 3', 'price' => 799000, 'duration' => 3]);
        Service::create(['name' => 'Complete', 'price' => 4999000, 'duration' => 5]);
    }
}