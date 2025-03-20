<?php

namespace App\Observers;

use App\Models\AuditReport;
use App\Models\Supply;
use App\Models\SupplyReport;
use Illuminate\Support\Facades\Log;

class SupplyObserver
{
    /**
     * Handle the Supply "updating" event.
     */
    public function updating(Supply $supply)
    {
        Log::info("🔄 Observer Triggered for Supply ID: {$supply->id}");
    
        if ($supply->isDirty('remaining_stock')) {
            Log::info("📉 Stock Change Detected: Old Stock - {$supply->getOriginal('remaining_stock')}, New Stock - {$supply->remaining_stock}");
        }
    
        if ($supply->isDirty('remaining_stock') && $supply->remaining_stock <= $supply->reorder_level) {
            Log::info("⚠️ Stock Below Reorder Level: {$supply->remaining_stock}");
    
            $existingReport = SupplyReport::where('supply_id', $supply->id)
                ->where('status', 'Pending Review')
                ->first();
    
            if (!$existingReport) {
                SupplyReport::create([
                    'supply_id' => $supply->id,
                    'report_title' => 'Low Supply Stock Warning',
                    'report_details' => "The supply '{$supply->supply_name}' (ID: {$supply->id}) is low with only {$supply->remaining_stock} left.",
                    'status' => 'Pending Review',
                ]);
    
                Log::info("✅ Audit report created for low stock: Supply ID {$supply->id}");
            } else {
                Log::info("🔍 Existing pending report found, skipping new report creation.");
            }
        }
    }
    

    /**
     * Handle the Supply "deleted" event.
     */
    public function deleted(Supply $supply): void
    {
        Log::info("Supply deleted: ID {$supply->id}");
    }

    /**
     * Handle the Supply "restored" event.
     */
    public function restored(Supply $supply): void
    {
        Log::info("Supply restored: ID {$supply->id}");
    }

    /**
     * Handle the Supply "force deleted" event.
     */
    public function forceDeleted(Supply $supply): void
    {
        Log::info("Supply permanently deleted: ID {$supply->id}");
    }
}
