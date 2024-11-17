<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleReservationController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;


// Redirect the root URL to the login page
Route::get('/', function () {
    return redirect()->route('login');
});


// Route::get('/base', function () {
//     return view('base');
// })->middleware('is_admin:admin');

// Define the login route
Route::get('login', function () {
    return view('auth.login');
})->name('login');


//Vendor Portal
Route::resource('vendor', VendorController::class);
Route::resource('auction', AuctionController::class);
Route::resource('supplier', SupplierController::class);



//Audit Management
Route::resource('supply', SupplyController::class);
Route::resource('assets', AssetController::class);
Route::resource('record', RecordController::class);


//Fleet Management
Route::resource('vehicle', VehicleController::class);
Route::resource('driver', DriverController::class);
Route::resource('trip', TripController::class);
Route::resource('maintenance', MaintenanceController::class);
Route::resource('fuel', FuelController::class);


//Document Tracking
Route::resource('document', DocumentController::class);


//Vehicle Reservation
// Route::resource('vehicle_reservation', VehicleReservationController::class);

Route::get('/vehiclereservation', [VehicleReservationController::class, 'index'])->name('reservation.index');






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
