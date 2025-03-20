<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    protected $table = 'fuels';

    protected $fillable = [
        'vehicle_id',
        'refill_date',
        'fuel_amount',
        'cost',
        'total_cost',
        'fuel_station',
        'fuel_station_location',
        'fuel_type',
        'odometer_reading',
        'fuel_efficiency',
        'payment_method',
        'receipt_number',
        'vendor_contact',
        'fuel_status',
        'approved_by',
    ];

    // Define a relationship with the Vehicle model
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Define a relationship with the User model (Approver)
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
