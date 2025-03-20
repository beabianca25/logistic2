<?php

namespace App\Providers;


use App\Events\GenerateAuditReport;
use App\Listeners\GenerateAuditReportListener;
use Carbon\Laravel\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SupplyStockChanged::class => [
            UpdateSupplyReportOnStockChange::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
