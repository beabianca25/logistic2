<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'vehicle_type',
        'model',
        'manufacturer',
        'year_of_manufacture',
        'license_plate',
        'vin',
        'capacity',
        'fuel_type',
        'mileage',
        'color',
        'engine_number',
        'chassis_number',
        'gps_tracking_id',
        'last_maintenance_date',
        'next_maintenance_due',
        'purchase_date',
        'purchase_price',
        'depreciation_value',
        'registration_expiry_date',
        'owner_name',
        'leasing_details',
        'current_status',
        'insurance_info',
        'image_path',
        'remarks',
    ];

    // Relationship with drivers
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    // Relationship with trips
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    // Relationship with maintenances
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    // Relationship with fuels
    public function fuels()
    {
        return $this->hasMany(Fuel::class);
    }

    // Many-to-Many Relationship with VehicleReservation
    public function reservations()
    {
        return $this->belongsToMany(VehicleReservation::class, 'reservation_vehicle')
                    ->withTimestamps();
    }

}
