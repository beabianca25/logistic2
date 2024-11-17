<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('login', function () {
    return view('auth.login');
});

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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
