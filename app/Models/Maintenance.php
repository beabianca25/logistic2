<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $table = 'maintenances';
    protected $fillable = [
        'vehicle_id',
        'maintenance_type',
        'maintenance_date',
        'service_vendor',
        'cost',
        'status',
    ];

    // Define the relationship with the Vehicle model
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
