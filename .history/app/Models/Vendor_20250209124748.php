<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'registration_number',
        'business_type',
        'industry_segment',
        'number_of_employees',
        'geographical_coverage',
        'business_address',
        'contact_phone',
        'contact_email',
        'website_url',
    ];

    public function certifications()
    {
        return $this->hasMany(VendorCertification::class, 'vendor_id');
    }

    public function consents()
    {
        return $this->hasMany(VendorConsent::class, 'vendor_id');
    }

    public function contacts()
    {
        return $this->hasMany(VendorContact::class, 'vendor_id');
    }

    public function reviews()
    {
        return $this->hasMany(VendorReview::class, 'vendor_id');
    }

    public function services()
    {
        return $this->hasMany(VendorService::class, 'vendor_id');
    }

    public function invoices()
    {
        return $this->hasMany(VendorInvoicing::class, 'vendor_id');
    }
}
