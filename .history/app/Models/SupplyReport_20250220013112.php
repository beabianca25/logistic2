<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_id',
        'report_title',
        'description',
        'status',
        'location',
        'report_date',
    ];

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }
}
