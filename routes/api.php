<?php

use App\Http\Controllers\VehicleReleaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/reservation', [VehicleReleaseController::class, 'reservation']);
