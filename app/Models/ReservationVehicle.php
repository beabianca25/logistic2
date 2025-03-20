<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ReservationVehicle extends Pivot
{
    protected $table = 'reservation_vehicle'; // Define the pivot table name

    protected $fillable = [
        'vehicle_reservation_id',
        'vehicle_id',
    ];

    public $timestamps = true; // Since your migration includes timestamps

    /**
     * Relationship with VehicleReservation.
     */
    public function reservation()
    {
        return $this->belongsTo(VehicleReservation::class, 'vehicle_reservation_id');
    }

    /**
     * Relationship with Vehicle.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
