<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'drivers';
    protected $fillable = [
        'vehicle_id',
        'driver_name',
        'license_number',
        'contact_number',
        'email',
        'address',
        'certifications',
        'license_expiry_date',
        'status',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
