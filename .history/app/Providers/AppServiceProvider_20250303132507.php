<?php

namespace App\Providers;

use App\Models\Asset;
use App\Models\Supply;
use App\Observers\AssetObserver;
use App\Observers\SupplyObserver;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{

    protected $listen = [
        AssetStockUpdated::class => [
            UpdateAssetAudit::class,
        ],
    ];
    
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
        Asset::observe(AssetObserver::class);


        Route::model('role', Role::class);
    }
}
