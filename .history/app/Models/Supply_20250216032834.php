<?php

namespace App\Models;

use App\Events\LowStockDetected;
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

    public static function boot()
    {
        parent::boot();

        static::updated(function ($supply) {
            if ($supply->checkStock()) {
                event(new LowStockDetected($supply));
            }
        });
    }

}
