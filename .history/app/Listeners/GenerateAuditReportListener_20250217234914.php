<?php

namespace App\Listeners;

use App\Events\StockUpdated;
use App\Models\AuditReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateAuditReportListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StockUpdated $event)
    {
        // Handle asset update
        if ($event->asset) {
            AuditReport::create([
                'asset_id' => $event->asset->id, // Store asset_id
                'report_title' => 'Asset Stock Updated',
                'report_details' => "Asset: {$event->asset->asset_name} updated. Status: {$event->asset->usage_status}",
                'status' => 'Pending Review',
                'location' => $event->asset->location,
                'report_date' => now(),
            ]);
        }

        // Handle supply update
        if ($event->supply) {
            AuditReport::create([
                'supply_id' => $event->supply->id, // Store supply_id
                'report_title' => 'Supply Stock Updated',
                'report_details' => "Supply: {$event->supply->supply_name} updated. Remaining stock: {$event->supply->remaining_stock}",
                'status' => 'Pending Review',
                'location' => $event->supply->storage_location,
                'report_date' => now(),
            ]);
        }
    }
}
