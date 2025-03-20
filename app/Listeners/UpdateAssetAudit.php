<?php

namespace App\Listeners;

use App\Events\AssetStockUpdated;
use App\Models\AuditReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateAssetAudit
{

    use InteractsWithQueue;

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
    public function handle(AssetStockUpdated $event)
    {
        AuditReport::create([
            'asset_id' => $event->asset->id,
            'status' => $event->asset->usage_status,
            'updated_at' => now(),
        ]);
    }
}
