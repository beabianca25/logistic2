<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        
        'vehicle_id',
        'registration_number',
        'number_of_seats',
        'driver_id',
        'category',
        'status',
        'vehicle_picture',
    ];
}
