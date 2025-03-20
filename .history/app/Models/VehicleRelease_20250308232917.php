<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRelease extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_reservation_id',
        'customer_name',
        'customer_contact',
        'reservation_start_date',
        'release_date',
        'drop_off_date',
        'released_by',
        'condition_report',
        'total_cost',
        'payment_status',
        'status',
        'notes',
    ];

    // Relationship with VehicleReservation
    public function reservation()
    {
        return $this->belongsTo(VehicleReservation::class, 'vehicle_reservation_id');
    }

    public static function boot()
    {
        parent::boot();

        static::updated(function ($release) {
            // Check if status changed to 'Completed'
            if ($release->isDirty('status') && $release->status === 'Completed') {
                // Move data to history table
                VehicleReleaseHistory::create($release->toArray());

                // Delete the record from the main table
                $release->delete();
            }
        });
    }
}
