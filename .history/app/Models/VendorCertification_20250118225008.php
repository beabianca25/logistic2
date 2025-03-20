<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class VendorCertification extends Model
{

    protected $table = 'vendor_certifications'; 
  
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

    // Generate a URL for the certification file
    public function getFileUrlAttribute()
    {
        return Storage::url($this->file_path);
    }
}
