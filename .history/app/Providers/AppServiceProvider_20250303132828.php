<?php

namespace App\Providers;

use App\Models\Asset;
use App\Models\Supply;
use App\Observers\AssetObserver;
use App\Observers\SupplyObserver;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register observers
        Supply::observe(SupplyObserver::class);
        Asset::observe(AssetObserver::class);

        // Correct route model binding for roles
        Route::bind('role', function ($value) {
            return Role::findOrFail($value);
        });
    }
}
