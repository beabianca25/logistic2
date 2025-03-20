<?php

namespace App\Providers;


use App\Events\GenerateAuditReport;
use App\Listeners\GenerateAuditReportListener;
use Carbon\Laravel\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        GenerateAuditReport::class => [
            GenerateAuditReportListener::class,
        ],
    ];
}
