<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class VehicleList extends Component
{
    public function getVehiclesProperty(): \Illuminate\Database\Eloquent\Collection
    {
        return Vehicle::all();
    }

    public function deleteVehicle(int $vehicleId)
    {
        $vehicle = Vehicle::find($vehicleId);
        $vehicle->delete();
        Session::flash('success', 'Vehicle deleted successfully');
    }

    public function render()
    {
        return view('livewire.vehicle-list');
    }
}
