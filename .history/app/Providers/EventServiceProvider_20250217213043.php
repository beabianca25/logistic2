<?php

namespace App\Providers;


use App\Events\GenerateAuditReport;
use App\Listeners\GenerateAuditReportListener;
use Carbon\Laravel\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        StockUpdated::class => [
            GenerateAuditReport::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
