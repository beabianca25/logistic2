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
        'license_plate',
        'vin',
        'capacity',
        'current_status',
        'insurance_info',
        'image_path',
    ];

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function fuels()
    {
        return $this->hasMany(Fuel::class);
    }


}
