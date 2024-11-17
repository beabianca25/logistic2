<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';
    protected $fillable = [
        'make',
        'model',
        'year',
        'vin',
        'registration_number',
        'capacity',
        'current_status',
        'insurance_info',
        'image_path',
        
        // Driver details
        'name',
        'license_number',
        'contact_number',
        'email',
        'address',
        'certifications',
        'license_expiry_date',
        'status',
        
        // Trip details
        'trip_starting_location',
        'trip_destination',
        'trip_departure_time',
        'trip_expected_arrival_time',
        'trip_status',
        
        // Maintenance details
        'maintenance_type',
        'maintenance_date',
        'service_vendor',
        'maintenance_cost',
        'maintenance_status',
        
        // Fuel records
        'fuel_refill_date',
        'fuel_amount',
        'fuel_cost',
        'fuel_station',
        
        // Expense records
        'expense_type',
        'expense_date',
        'expense_amount',
        'expense_description'
    ];

    /**
     * Accessor to get the full path of the vehicle's image.
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    /**
     * Accessor to check if the driver is active.
     */
    public function isDriverActive()
    {
        return $this->status === 'active';
    }

    /**
     * Accessor to check if the trip is in progress.
     */
    public function isTripInProgress()
    {
        return $this->trip_status === 'in_progress';
    }

    /**
     * Accessor to check if maintenance is pending.
     */
    public function isMaintenancePending()
    {
        return $this->maintenance_status === 'pending';
    }
}
