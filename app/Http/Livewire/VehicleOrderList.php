<?php

namespace App\Http\Livewire;

use App\Models\ActivityLog;
use App\Models\VehicleOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VehicleOrderList extends Component
{
    public $vehicleOrders;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount()
    {
        $role = Auth::user()->getRoleNames()->first();

        $vehicleOrders = VehicleOrder::when(!in_array($role,['admin','supervisor']), function($query){
            $query->where('orderer_id', Auth::id())->orWhere('approver_id', Auth::id());
        })->with('vehicle', 'driver', 'approver')->get();
        $this->vehicleOrders = $vehicleOrders;
    }

    public function approverApprove(int $id):void
    {
        $this->approvalHandler($id, VehicleOrder::APPROVED);
    }

    public function approverReject($id): void
    {
        $this->approvalHandler($id, VehicleOrder::REJECTED);
    }

    protected function approvalHandler(int $id, string $status)
    {
        if(!Auth::user()->hasRole('approver')){
            return abort(403);
        }

        $vehicleOrder = VehicleOrder::find($id);
        $approvalStatus = $vehicleOrder->vehicleOrderApproval->status;

        if($approvalStatus === VehicleOrder::PENDING) {
            $vehicleOrder->vehicleOrderApproval->forceFill([
                'status' => $status,
            ])->save();
            $this->emitSelf('refresh');
        }

        $statusText = $status === VehicleOrder::APPROVED ? 'Approve' : 'Reject';

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $statusText.' vehicle order with order number: ' . $vehicleOrder->order_number,
        ]);
    }

    public function supervisorApprove(int $id):void
    {
        $this->supervisorApprovalHandler($id, VehicleOrder::APPROVED);

    }

    public function supervisorReject(int $id):void
    {
        $this->supervisorApprovalHandler($id, VehicleOrder::REJECTED);
    }

    protected function supervisorApprovalHandler(int $id, string $status)
    {
        if(!Auth::user()->hasRole('supervisor')){
            return abort(403);
        }

        $vehicleOrder = VehicleOrder::find($id);
        $approvalStatus = $vehicleOrder->vehicleOrderApproval->status;
        $supervisorApproval = $vehicleOrder->approved_by_supervisor;

        if($approvalStatus === VehicleOrder::APPROVED && $supervisorApproval === VehicleOrder::PENDING){
            $vehicleOrder->forceFill([
                'approved_by_supervisor' => $status,
            ])->save();
            $this->emitSelf('refresh');
        }

        $statusText = $status === VehicleOrder::APPROVED ? 'Approve' : 'Reject';
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $statusText.' vehicle order with order number: ' . $vehicleOrder->order_number,
        ]);
    }

    public function render()
    {
        return view('livewire.vehicle-order-list');
    }
}
