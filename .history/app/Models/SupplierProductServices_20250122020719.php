<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierProductServices extends Model
{
    use HasFactory;

    protected $table = 'product_services';  // Correct table name with underscore


    // The attributes that are mass assignable.
    protected $fillable = [
        'supplier_id',
        'category',
        'description',
        'price',
        'lead_time',
        'minimum_order',
    ];

    // Define the relationship to the Supplier model.
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
