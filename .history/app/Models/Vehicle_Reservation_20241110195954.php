<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';

    protected $fillable = [
        'vehicle_id', 
        'seats', 
        'driver_id', 
        'status', 
        'location', 
        'availability_date'
    ];

    // Relationship with the Vehicle model
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relationship with the Driver model
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
