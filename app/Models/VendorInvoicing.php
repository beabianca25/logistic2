<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorInvoicing extends Model
{
    protected $table = 'vendor_invoicing';

  
    protected $fillable = [
        'vendor_id',
        'accounts_payable_name',
        'accounts_payable_email',
        'postal_address',
        'requires_po',
        'additional_instructions',
    ];

    /**
     * Get the vendor that owns the invoicing information.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
