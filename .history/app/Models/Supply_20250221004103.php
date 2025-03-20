<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

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
        'maintenance_schedule'
    ];

    public $timestamps = true; // ✅ Ensure timestamps are enabled

    public function supplyReport()
    {
        return $this->hasMany(AuditReport::class);
    }
}
