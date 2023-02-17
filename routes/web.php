<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleOrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

Route::group(['prefix' => 'vehicle-order', 'as' => 'vehicle-order.'], function () {
    Route::get('/', [VehicleOrderController::class, 'index'])->name('index');
    Route::get('/create', [VehicleOrderController::class, 'create'])->name('create');
    Route::post('/', [VehicleOrderController::class, 'store'])->name('store');
    Route::get('/export', [VehicleOrderController::class, 'export'])->name('export');
});

Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');

Route::resource('/vehicle', VehicleController::class);
Route::resource('/driver', DriverController::class);

});
