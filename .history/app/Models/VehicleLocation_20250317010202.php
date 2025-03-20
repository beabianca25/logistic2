<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleLocation extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_id', 'latitude', 'longitude', 'recorded_at'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
