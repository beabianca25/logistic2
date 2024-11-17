<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ComposeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleReleaseController;
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
Route::resource('bid', BidController::class);
Route::resource('buyer',BuyerController::class);
Route::get('/bids/create/{auction_id}', [BidController::class, 'create'])->name('bid.create');
Route::post('/bid/store/{auction_id}', [BidController::class, 'store'])->name('bid.store');





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
Route::resource('reservation', VehicleReservationController::class);
Route::resource('release', VehicleReleaseController::class);


Route::get('/event', [EventController::class, 'index'])->name('event');
Route::get('/inbox', [InboxController::class, 'index'])->name('inbox');
Route::get('/compose', [ComposeController::class,'index'])->name('compose');
Route::get('/read', [ReadController::class,'index'])->name('read');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
