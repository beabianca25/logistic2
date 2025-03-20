<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorService extends Model
{

    protected $fillable = [
        'vendor_id',
        'service_category',
        'service_description',
        'areas_of_operation',
        'price_range',
    ];

    /**
     * Get the vendor that owns the service.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
