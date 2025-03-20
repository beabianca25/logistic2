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


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Get the user who created the reservation.
     */

    /**
     * The vehicles associated with the reservation.
     */

   // Many-to-Many Relationship with Vehicles
  // Many-to-Many Relationship
  public function vehicles()
  {
      return $this->belongsToMany(Vehicle::class, 'reservation_vehicle', 'vehicle_reservation_id', 'vehicle_id');
  }

   // Relationship with VehicleRelease
   public function release()
   {
       return $this->hasOne(VehicleRelease::class, 'vehicle_reservation_id');
   }
    
}
