<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredController::class, 'create'])->name('register');
    Route::post('register', [RegisteredController::class, 'store']);

    Route::get('login', [LoginController::class, 'create']) ->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::middleware('auth:admin')->group(function () {

    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout');
});
