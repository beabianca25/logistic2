<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_id', 'issued_to', 'quantity_used', 'usage_reason', 'usage_date'
    ];

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }
}
