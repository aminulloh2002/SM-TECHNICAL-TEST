<?php

namespace App\Http\Livewire;

use App\Models\Driver;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class DriverList extends Component
{
    public function getDriversProperty(): \Illuminate\Database\Eloquent\Collection
    {
        return Driver::all();
    }

    public function deleteDriver(int $driverId)
    {
        $driver = Driver::find($driverId);
        $driver->delete();
        Session::flash('success', 'Driver deleted successfully');
    }

    public function render()
    {
        return view('livewire.driver-list');
    }
}
