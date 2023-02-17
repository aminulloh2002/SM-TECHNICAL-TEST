<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::insert([
            [
                'name' => 'Driver 1',
                'phone' => '123456789',
                'address' => 'Address 1',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Driver 2',
                'phone' => '123456789',
                'address' => 'Address 2',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Driver 3',
                'phone' => '123456789',
                'address' => 'Address 3',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
