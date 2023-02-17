<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::insert([
            [
                'name' => 'Car',
                'plate' => 'N 12345 PL',
                'type' => 'Rental car',
                'fuel_per_km' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Bus',
                'plate' => 'N 12345 AT',
                'type' => 'People carrier',
                'fuel_per_km' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Truck',
                'plate' => 'N 12345 BA',
                'type' => 'Freight transport',
                'fuel_per_km' => 3,
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
