<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';
    protected $fillable = [
        'model',
        'year',
        'vin',
        'registration_number',
        'current_status',
        'image_path',
        'name',
        'license_number',
        'contact_number',
        'license_expiry_date',
        'status',
        'maintenance_schedule',
        'fuel_refill_date',
    ];

    /**
     * Accessor to get the full path of the vehicle's image.
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }


}
