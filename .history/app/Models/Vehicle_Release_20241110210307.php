<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_Release extends Model
{
    use HasFactory;

    protected $table = 'vehicle_releases';

    protected $fillable = [
        'vehicle_id',
        'customer_name',
        'customer_contact',
        'reservation_date',
        'release_date',
        'drop_off_date',
        'released_by',
        'condition_report',
        'total_cost',
        'payment_status',
        'notes',
    ];
}
