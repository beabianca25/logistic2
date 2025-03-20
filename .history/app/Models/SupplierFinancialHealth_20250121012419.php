<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierFinancialHealth extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'supplier_financial_health';

    // The attributes that are mass assignable.
    protected $fillable = [
        'supplier_id',
        'bank_account_number',
        'tax_compliance',
        'insurance_coverage',
    ];

    // Define the relationship to the Supplier model.
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
