<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    use HasFactory;
    protected $table = 'suppliers';

    protected $fillable = [
        'company_name', 'business_type', 'contact_name', 'contact_email',
        'contact_phone', 'business_address', 'website'
    ];

    public function legalcompliance()
    {
        return $this->hasOne(SupplierLegalCompliance::class, 'supplier_id');
    }

    public function productservices()
    {
        return $this->hasMany(SupplierProductServices::class);
    }

    public function financialhealth()
    {
        return $this->hasOne(SupplierFinancialHealth::class);
    }

    public function references()
    {
        return $this->hasMany(SupplierReference::class);
    }


}
