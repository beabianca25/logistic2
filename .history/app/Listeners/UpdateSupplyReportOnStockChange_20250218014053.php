<?php

namespace App\Listeners;

use App\Events\SupplyStockChanged;
use App\Models\SupplyReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class UpdateSupplyReportOnStockChange
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
    public function handle(SupplyStockChanged $event)
    {
        // Get the supply, quantity changed, and action (increase or decrease)
        $supply = $event->supply;
        $quantityChanged = $event->quantityChanged;
        $action = $event->action;

        // Generate report title based on action (increase or decrease)
        $reportTitle = $action == 'increase' ? 'Stock Increased' : 'Stock Decreased';
        $description = "The stock of {$supply->supply_name} has {$action} by {$quantityChanged} units.";

        // Create a new supply report entry
        SupplyReport::create([
            'supply_id' => $supply->id,
            'report_title' => $reportTitle,
            'description' => $description,
            'status' => 'Pending',
            'location' => $supply->storage_location,
            'report_date' => Carbon::now(),
        ]);
        
        // Optionally, send notification to the admin about the stock change
        // Notification::send($admin, new SupplyStockChangedNotification($supply));
    }
}
