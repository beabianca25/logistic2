<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorContact extends Model
{
    protected $table = 'VendorContact';

  
    protected $fillable = [
        'vendor_id',
        'first_name',
        'last_name',
        'job_title',
        'phone',
        'email',
    ];

    /**
     * Get the vendor that owns the contact.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
