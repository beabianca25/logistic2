<?php

namespace App\Listeners;

use App\Events\SupplyStockChanged;
use App\Models\SupplyReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Log;

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
    public function handle(object $event): void
    {
        $supply = $event->supply;

        SupplyReport::create([
            'supply_id' => $supply->id,
            'report_title' => 'Low Stock Warning',
            'report_details' => "The supply '{$supply->supply_name}' (ID: {$supply->id}) is low with only {$supply->remaining_stock} left.",
            'status' => 'Pending Review',
        ]);

        Log::info("Low stock alert triggered for: {$supply->supply_name} (ID: {$supply->id}), Remaining Stock: {$supply->remaining_stock}");
    }
}
