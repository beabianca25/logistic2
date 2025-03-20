<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorConsent extends Model
{

    protected $table = 'vendorconsent'; 
    protected $fillable = [
        'vendor_id',
        'authorized_person_name',
        'contract_email',
        'agreement_to_terms',
        'agreement_to_credit_check',
        'signature',
    ];

    /**
     * Get the vendor that owns the consent.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
