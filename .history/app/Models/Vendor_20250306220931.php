<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendors';
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
        return $this->hasMany(VendorCertification::class);
    }

    public function consents()
    {
        return $this->hasMany(VendorConsent::class);
    }

    public function contacts()
    {
        return $this->hasMany(VendorContact::class);
    }

    public function reviews()
    {
        return $this->hasMany(VendorReview::class);
    }

    public function services()
    {
        return $this->hasMany(VendorService::class);
    }

    public function invoices()
    {
        return $this->hasMany(VendorInvoicing::class);
    }


}
