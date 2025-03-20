<?php

namespace App\Models;

use App\Events\LowStockDetected;
use App\Events\StockUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $table = 'supplies';

    protected $fillable = [
        'supply_name',
        'category',
        'description',
        'supplier_vendor',
        'quantity_purchased',
        'unit_of_measurement',
        'stock_on_hand',
        'reorder_level',
        'unit_price',
        'total_cost',
        'purchase_date',
        'invoice_receipt_number',
        'issued_to',
        'date_issued',
        'purpose_usage',
        'remaining_stock',
        'storage_location',
        'condition',
        'expiration_date',
        'maintenance_schedule',
    ];



    public function checkStock()
    {
        return $this->stock_on_hand <= $this->reorder_level;
    }

    protected static function booted()
    {
        static::updated(function ($supply) {
            // Check if the supply was updated and dispatch the event
            event(new StockUpdated(null, $supply));
        });
    }

    // In Supply model
public function auditReports()
{
    return $this->morphMany(AuditReport::class, 'auditable');
}



}
