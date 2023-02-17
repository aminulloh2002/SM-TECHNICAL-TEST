<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const APPROVED = 'approved';
    public const REJECTED = 'rejected';
    public const PENDING = 'pending';

    public static function generateOrderNumber(): string
    {
        $lastOrder = self::orderBy('id','desc')->first();
        if ($lastOrder) {
            $lastOrderNumber = $lastOrder->order_number;
            $lastOrderNumber = (int) substr($lastOrderNumber, 2);
            $lastOrderNumber++;
            $lastOrderNumber = str_pad($lastOrderNumber, 4, '0', STR_PAD_LEFT);
            return 'VO' . $lastOrderNumber;
        }
        return 'VO0001';
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function orderer()
    {
        return $this->belongsTo(User::class, 'orderer_id');
    }

    public function vehicleOrderApproval()
    {
        return $this->hasOne(VehicleOrderApproval::class);
    }

    public function getStartDateAttribute($value)
    {
        return date('d M Y', strtotime($value));
    }

    public function getEndDateAttribute($value)
    {
        return date('d M Y', strtotime($value));
    }

    public function getTravelDistanceAttribute($value)
    {
        return $value. ' km';
    }

    public function getStatusAttribute($value)
    {

        if($this->vehicleOrderApproval->status === self::APPROVED && $this->approved_by_supervisor === self::APPROVED) {
            return '<span class="badge badge-success">Approved</span>';
        } else if($this->vehicleOrderApproval->status === self::REJECTED) {
            return '<span class="badge badge-danger">Rejected by approvers</span>';
        } else if($this->vehicleOrderApproval->status === self::PENDING) {
            return '<span class="badge badge-warning">Waiting for approvers</span>';
        } else if($this->approved_by_supervisor === self::REJECTED) {
            return '<span class="badge badge-danger">Rejected by Supervisor</span>';
        } else if($this->approved_by_supervisor === self::PENDING) {
            return '<span class="badge badge-warning">Waiting for Supervisor approval</span>';
        }

    }
}
