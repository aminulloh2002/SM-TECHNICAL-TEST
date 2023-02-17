<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use App\Models\Driver;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->hasRole('admin')) {
                return $next($request);
            }
            abort(403, 'Unauthorized action.');
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('driver.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('driver.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DriverRequest $request): RedirectResponse
    {
        Driver::create($request->validated());

        return redirect()->route('driver.index')->with('success', 'Driver created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver): View
    {
        return view('driver.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DriverRequest $request, Driver $driver): RedirectResponse
    {
        $driver->update($request->validated());

        return redirect()->route('driver.index')->with('success', 'Driver updated successfully');
    }
}
