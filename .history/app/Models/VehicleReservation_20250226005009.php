<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_code', 'customer_name', 'customer_contact',
        'vehicle_count', 'driver_id', 'status', 'location',
        'reservation_notes', 'reservation_start_date',
        'reservation_end_date', 'total_price', 'user_id'
    ];

    /**
     * Get the driver assigned to the reservation.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    /**
     * Get the user who created the reservation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The vehicles associated with the reservation.
     */
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'reservation_vehicle', 'vehicle_reservation_id', 'vehicle_id')->using(ReservationVehicle::class);
    }
    
}
