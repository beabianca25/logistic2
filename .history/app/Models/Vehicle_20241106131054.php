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


}
