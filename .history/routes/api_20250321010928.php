<?php

use App\Http\Controllers\VehicleReleaseController;
use App\Http\Controllers\VehicleReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/reservation', [VehicleReservationController::class, 'reservation']);
