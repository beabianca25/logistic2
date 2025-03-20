<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierFinancialHealth extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'supplier_financial_health';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_id',
        'bank_account_number',
        'tax_compliance',
        'insurance_coverage',
    ];

    /**
     * Get the supplier that owns the financial health record.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
