<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleReleaseHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_release_id',
        'vehicle_reservation_id',
        'customer_name',
        'customer_contact',
        'reservation_start_date',
        'release_date',
        'drop_off_date',
        'released_by',
        'condition_report',
        'total_cost',
        'payment_status',
        'status',
        'notes',
    ];
}
