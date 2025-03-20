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
       return $this->hasMany(AuditReport::class);
   }

   public static function boot()
   {
       parent::boot();
   
       static::updated(function ($asset) {
           // If asset is under maintenance, expired warranty, or disposed, create a report
           if ($asset->usage_status === 'Under Maintenance') {
               AssetReport::create([
                   'asset_id' => $asset->id,
                   'report_title' => 'Asset Under Maintenance',
                   'report_details' => "The asset '{$asset->asset_name}' is currently under maintenance.",
                   'report_type' => 'Maintenance',
                   'status' => 'Pending Review',
                   'report_date' => now(),
               ]);
           }
   
           if ($asset->warranty_expiry_date && $asset->warranty_expiry_date < now()) {
               AssetReport::create([
                   'asset_id' => $asset->id,
                   'report_title' => 'Warranty Expired',
                   'report_details' => "The warranty for asset '{$asset->asset_name}' has expired.",
                   'report_type' => 'Warranty Expiry',
                   'status' => 'Pending Review',
                   'report_date' => now(),
               ]);
           }
   
           if ($asset->usage_status === 'Retired') {
               AssetReport::create([
                   'asset_id' => $asset->id,
                   'report_title' => 'Asset Retired',
                   'report_details' => "The asset '{$asset->asset_name}' has been retired.",
                   'report_type' => 'Disposal',
                   'status' => 'Pending Review',
                   'report_date' => now(),
               ]);
           }
       });
   }
   

}
