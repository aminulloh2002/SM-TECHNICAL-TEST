<?php

namespace App\Http\Controllers;

use App\Exports\VehicleOrdersExport;
use App\Http\Requests\ExportCSVRequest;
use App\Http\Requests\VehicleOrderRequest;
use App\Http\Service\VehicleOrderService;
use App\Models\ActivityLog;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleOrder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class VehicleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('vehicle-order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Gate::authorize('isAdminOrEmployee');

        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $approvers = User::approvers()->get();
        return view('vehicle-order.create', compact('vehicles', 'approvers', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleOrderRequest $request, VehicleOrderService $service): RedirectResponse
    {
        Gate::authorize('isAdminOrEmployee');

        $service->createOrder($request->validated());

        return redirect()->route('vehicle-order.index')->with('success', 'Vehicle order created successfully');
    }

    public function export(ExportCSVRequest $request)
    {
        Gate::authorize('isAdminOrEmployee');

        $to = Carbon::createFromFormat('Y-m-d',$request->to)->startOfDay();
        $from = Carbon::createFromFormat('Y-m-d',$request->from)->endOfDay();

        $vehicleOrders = VehicleOrder::with(['vehicle', 'approver','orderer','driver'])
        ->whereBetween('start_date',[$from,$to])
        ->orWhereBetween('end_date', [$from, $to])
        ->get();

        if($vehicleOrders->isEmpty()){
            return redirect()->back()->with('export-error', 'No vehicle orders found');
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Exported vehicle orders',
        ]);

        return Excel::download(new VehicleOrdersExport($vehicleOrders), 'vehicle-orders-'.$from.'-'.$to.'.xlsx');
    }

}
