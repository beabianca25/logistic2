<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'refill_date',
        'fuel_amount',
        'cost',
        'fuel_station',
        'status',
    ];

    // Define a relationship to the Vehicle model (if exists)
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
