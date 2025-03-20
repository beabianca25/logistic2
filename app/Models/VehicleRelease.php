<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
  

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($release) {
            if ($release->isDirty('status') && $release->status === 'Completed') {
                // Move data to history table, ensuring we only transfer relevant data
                VehicleReleaseHistory::create([
                    'vehicle_release_id' => $release->id,
                    'vehicle_reservation_id' => $release->vehicle_reservation_id,
                    'customer_name' => $release->customer_name,
                    'customer_contact' => $release->customer_contact,
                    'reservation_start_date' => $release->reservation_start_date,
                    'release_date' => $release->release_date,
                    'drop_off_date' => $release->drop_off_date,
                    'released_by' => $release->released_by,
                    'condition_report' => $release->condition_report,
                    'total_cost' => $release->total_cost,
                    'payment_status' => $release->payment_status,
                    'status' => 'Completed', // Ensure it stays 'Completed'
                    'notes' => $release->notes,
                ]);

                // Soft delete the original record
                $release->delete();
            }
        });
    }
}
