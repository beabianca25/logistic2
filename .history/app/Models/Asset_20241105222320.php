<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';
    protected $fillable = [
        'asset_name',
        'asset_type',
        'location',
        'condition',
        'status',
        'acquisition_date',
    ];
}
