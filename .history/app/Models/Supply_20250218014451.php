<?php

namespace App\Models;

use App\Events\LowStockDetected;
use App\Events\StockUpdated;
use App\Events\SupplyStockChanged;
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



    public function supplyReports()
    {
        return $this->hasMany(SupplyReport::class);
    }

    public function changeStock(int $quantity, string $action)
    {
        // Adjust the stock based on action
        if ($action == 'increase') {
            $this->remaining_stock += $quantity;
        } elseif ($action == 'decrease') {
            if ($this->remaining_stock >= $quantity) {
                $this->remaining_stock -= $quantity;
            }
        }

        // Save the supply after updating stock
        $this->save();

        // Trigger the event for stock change
        event(new SupplyStockChanged($this, $quantity, $action));
    }

}
