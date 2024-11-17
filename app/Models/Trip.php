<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $table = 'trips';
    protected $fillable = [
        'vehicle_id',
        'starting_location',
        'destination',
        'departure_time',
        'expected_arrival_time',
        'status',
    ];

    // Define the relationship with Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
