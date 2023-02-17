<?php

namespace App\Http\Controllers;

use App\Models\VehicleOrder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    protected function getPeriodProperty(): array
    {
        $period = Carbon::parse(now()->startOfYear()->toDateString())->monthsUntil(now()->endOfYear()->toDateString())->toArray();
        $chartData = [];

        foreach ($period as $itemPeriod) {
            $chartData[$itemPeriod->format('M y')] = 0;
        }

        return $chartData;
    }

    protected function getUserVehicleOrderChartData(bool $currentUserOnly = true)
    {
        $groupOrderByMonth = VehicleOrder::where('approved_by_supervisor','approved')->when($currentUserOnly,function ($query){
            $query->where('orderer_id',Auth::id());
        })->whereYear('created_at',Carbon::now()->year)
        ->select(DB::raw('sum(number_of_vehicle) as `total`'), DB::raw('DATE_FORMAT(start_date, \'%b %y\') as month_name'))
        ->groupby('month_name')
        ->get()
        ->flatMap(fn ($item) => [$item->month_name => (int)$item->total])
        ->toArray();;

        $chartPeriod = $this->getPeriodProperty();

        return array_merge($chartPeriod,$groupOrderByMonth);
    }

    protected function getFuelStatistics()
    {
        $fuelStatistics = VehicleOrder::where('approved_by_supervisor','approved')
        ->join('vehicles','vehicles.id','=','vehicle_orders.vehicle_id')
        ->select(
            DB::raw('sum(vehicles.fuel_per_km * vehicle_orders.number_of_vehicle * vehicle_orders.travel_distance) as `total_fuel`'),
            DB::raw('DATE_FORMAT(vehicle_orders.start_date, \'%b %y\') as month_name'))
        ->whereYear('vehicle_orders.start_date',Carbon::now()->year)
        ->groupBy('month_name')
        ->get()
        ->flatMap(fn ($item) => [$item->month_name => (int)$item->total_fuel])
        ->toArray();

        $chartPeriod = $this->getPeriodProperty();

        return array_merge($chartPeriod,$fuelStatistics);
    }

    public function index()
    {
        $chartData = $this->getUserVehicleOrderChartData();
        if(Auth::user()->hasAnyRole(['admin','supervisor'])){
            $fuelStatistics = $this->getFuelStatistics();
            $overallChartData = $this->getUserVehicleOrderChartData(false);
            return view('home',compact('chartData','overallChartData','fuelStatistics'));
        }
        return view('home',compact('chartData'));
    }
}
