<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierReference extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'supplierreferences';

    // The attributes that are mass assignable.
    protected $fillable = [
        'supplier_id',
        'client_name',
        'client_contact',
        'project_description',
    ];

    // Define the relationship to the Supplier model.
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
