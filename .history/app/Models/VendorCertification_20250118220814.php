<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorCertification extends Model
{
  
    protected $fillable = [
        'vendor_id',
        'certification_name',
        'certification_type',
        'file_path',
        'valid_until',
    ];

    /**
     * Get the vendor that owns the certification.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
