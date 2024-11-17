<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $table = 'supplies';
    protected $fillable = [
        'supply_name',
        'category',
        'quantity',
        'audit_date',
        'location',
        'condition',
        'status',
        'remarks',
        'auditor_name',
        'attachment'
    ];
}
