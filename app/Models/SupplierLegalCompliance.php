<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierLegalCompliance extends Model
{
    use HasFactory;

    protected $table = 'supplier_legal_compliance';

      // The attributes that are mass assignable.
      protected $fillable = [
        'supplier_id',
        'registration_number',
        'tax_identification_number',
        'licenses_certifications',
        'years_of_operation',
    ];

    // Define the relationship to the Supplier model.
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
