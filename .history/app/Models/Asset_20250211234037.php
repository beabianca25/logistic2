<?php

namespace App\Models;

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
}
