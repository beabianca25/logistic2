<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'user_id',
        'booking_type',
        'pickup_location',
        'dropoff_location',
        'notes',
        'booking_date',
        'status',
    ];

    // Relationships
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

