<?php

namespace App\Models;

use App\Events\StockUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets'; // Specify the table name

    protected $fillable = [
        // Basic Information
        'asset_name',
        'asset_category',
        'asset_tag',
        'description',

        // Acquisition Details
        'purchase_date',
        'supplier_vendor',
        'invoice_number',
        'cost_of_asset',

        // Ownership & Assignment
        'assigned_to',
        'location',
        'usage_status',

        // Maintenance & Warranty
        'warranty_expiry_date',
        'maintenance_schedule',
        'last_maintenance_date',

        // Disposal Details
        'disposal_date',
        'disposal_method',
        'resale_value',
    ];


   // In Asset model
public function auditReports()
{
    return $this->morphMany(AuditReport::class, 'auditable');
}


protected static function booted()
{
    static::updated(function ($asset) {
        // Check if the asset was updated and dispatch the event
        event(new StockUpdated($asset, null));
    });
}

}
