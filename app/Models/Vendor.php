<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{

    use HasFactory;
    protected $table = 'vendors';

    protected $fillable = [
        'vendor_name',
        'email',
        'phone',
        'business_license',
        'tax_information',
        'service_category',
        'contract_start_date',
        'contract_end_date',
    ];
}
