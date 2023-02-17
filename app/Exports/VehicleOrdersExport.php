<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VehicleOrdersExport implements FromView
{
    protected $vehicleOrders;

    function __construct($vehicleOrders) {
        $this->vehicleOrders = $vehicleOrders;
    }

    public function view(): View
    {
        $vehicleOrders = $this->vehicleOrders;
        return view('vehicle-order.export', compact('vehicleOrders'));
    }
}
