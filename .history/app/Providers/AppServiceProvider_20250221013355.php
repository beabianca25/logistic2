<?php

namespace App\Providers;

use App\Models\Supply;
use App\Observers\SupplyObserver;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        Supply::observe(SupplyObserver::class);
    }
}
