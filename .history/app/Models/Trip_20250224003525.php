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
        'driver_id',
        'starting_location',
        'destination',
        'trip_type',
        'departure_time',
        'expected_arrival_time',
        'actual_departure_time',
        'actual_arrival_time',
        'route_details',
        'distance_km',
        'passenger_count',
        'fuel_consumed',
        'fuel_cost',
        'trip_expenses',
        'gps_tracking_id',
        'incident_report',
        'weather_conditions',
        'delay_reason',
        'cargo_details',
        'trip_notes',
        'status',
    ];

    // Relationship with Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relationship with Driver
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
