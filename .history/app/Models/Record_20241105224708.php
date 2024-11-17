<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $table = 'records';

    protected $fillable = [
        'auditor_name',
        'audit_type',
        'item_or_asset_name',
        'condition',
        'notes',
        'audit_date',
        'status',
        'actions_taken',
    ];
}
