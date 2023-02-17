<?php

namespace Database\Seeders;

use App\Models\VehicleOrder;
use App\Models\VehicleOrderApproval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vo1 = VehicleOrder::create([
            'order_number' => "VO0001",
            'vehicle_id' => 1,
            'driver_id' => 1,
            'orderer_id' => 1,
            'approver_id' => 2,
            'number_of_vehicle' => 2,
            'start_date' => '2023-02-16',
            'end_date' => '2023-02-17',
            'travel_distance' => 12,
            'purpose' => 'pickup kids from school',
            'approved_by_supervisor' => 'pending',
        ]);


        VehicleOrderApproval::create([
            'vehicle_order_id' => $vo1->id,
            'user_id' => 2,
            'status' => 'pending',
        ]);

        $vo2 = VehicleOrder::create([
            'order_number' => "VO0002",
            'vehicle_id' => 2,
            'driver_id' => 2,
            'orderer_id' => 5,
            'number_of_vehicle' => 5,
            'approver_id' => 2,
            'start_date' => '2023-02-12',
            'end_date' => '2023-02-14',
            'travel_distance' => 20,
            'purpose' => 'traveling',
            'approved_by_supervisor' => 'approved',
        ]);

        VehicleOrderApproval::create([
            'vehicle_order_id' => $vo2->id,
            'user_id' => 2,
            'status' => 'approved',
        ]);

        $vo3 = VehicleOrder::create([
            'order_number' => "VO0003",
            'vehicle_id' => 2,
            'driver_id' => 2,
            'orderer_id' => 5,
            'number_of_vehicle' => 7,
            'approver_id' => 2,
            'start_date' => '2023-01-12',
            'end_date' => '2023-01-14',
            'travel_distance' => 20,
            'purpose' => 'traveling',
            'approved_by_supervisor' => 'approved',
        ]);

        VehicleOrderApproval::create([
            'vehicle_order_id' => $vo3->id,
            'user_id' => 2,
            'status' => 'approved',
        ]);
    }
}
