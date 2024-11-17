<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    use HasFactory;
    protected $table = 'supplier_requests';

    protected $fillable = [
        'supplier_name', 
        'product_service_description', 
        'price_quote', 
        'availability_lead_time', 
        'contact_information', 
        'attachments',
        'status'
    ];
}
