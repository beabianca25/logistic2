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
        $this->createAuditReport(
            $event->asset->id,
            'asset_id',
            'Asset Stock Updated',
            "Asset: {$event->asset->asset_name} updated. Status: {$event->asset->usage_status}",
            $event->asset->location
        );
    }

    // Handle supply update
    if ($event->supply) {
        $this->createAuditReport(
            $event->supply->id,
            'supply_id',
            'Supply Stock Updated',
            "Supply: {$event->supply->supply_name} updated. Remaining stock: {$event->supply->remaining_stock}",
            $event->supply->storage_location
        );
    }
}

/**
 * Create an audit report entry.
 *
 * @param int $entityId
 * @param string $entityType
 * @param string $title
 * @param string $details
 * @param string|null $location
 */
private function createAuditReport($entityId, $entityType, $title, $details, $location = null)
{
    AuditReport::create([
        $entityType     => $entityId, // Dynamically store either asset_id or supply_id
        'report_title'  => $title,
        'report_details' => $details,
        'status'        => 'Pending Review',
        'location'      => $location,
        'report_date'   => now(),
    ]);
}

}
