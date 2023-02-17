<?php
namespace App\Http\Service;

use App\Models\ActivityLog;
use App\Models\VehicleOrder;
use App\Models\VehicleOrderApproval;
use Illuminate\Support\Facades\Auth;

class VehicleOrderService {

    public function createOrder(array $data):void
    {
        $payload = [
            'order_number' => VehicleOrder::generateOrderNumber(),
            'vehicle_id' => $data['vehicle'],
            'driver_id' => $data['driver'],
            'approver_id' => $data['approver'],
            'purpose' => $data['purpose'],
            'number_of_vehicle' => $data['number_of_vehicle'],
            'travel_distance' => $data['travel_distance'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'orderer_id' => Auth::id(),
        ];

        $vehicleOrder = VehicleOrder::create($payload);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Created vehicle order with order number: ' . $vehicleOrder->order_number,
        ]);

        $this->createOrderApproval($vehicleOrder->id, $data['approver']);
    }

    public function createOrderApproval(int $orderId,int $approverId):void
    {
        $approvalPayload = [
            'vehicle_order_id' => $orderId,
            'user_id' => $approverId,
        ];

        VehicleOrderApproval::create($approvalPayload);
    }

}
