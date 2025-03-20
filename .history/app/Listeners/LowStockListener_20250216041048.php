<?php

namespace App\Listeners;

use App\Events\LowStockDetected;
use App\Models\AuditReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LowStockListener
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
    public function handle(LowStockDetected $event): void
    {
        $supply = $event->supply;

        // Create an audit report when stock is low
        AuditReport::create([
            'auditable_id' => $supply->id,
            'auditable_type' => get_class($supply), // This will be 'App\Models\Supply'
            'report_title' => 'Low Stock Warning',
            'report_details' => "The supply '{$supply->supply_name}' is running low. Only {$supply->stock_on_hand} left.",
            'status' => 'Pending Review',
            'location' => $supply->storage_location,
            'report_date' => now(),
        ]);
    }
}
