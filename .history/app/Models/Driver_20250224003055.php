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
        'date_of_birth',
        'gender',
        'national_id_number',
        'license_number',
        'license_category',
        'license_expiry_date',
        'contact_number',
        'email',
        'address',
        'employment_status',
        'hire_date',
        'termination_date',
        'driving_experience_years',
        'assigned_routes',
        'certifications',
        'background_check_status',
        'accident_history',
        'training_completed',
        'violation_records',
        'medical_fitness_certificate',
        'blood_type',
        'emergency_contact_name',
        'emergency_contact_number',
        'profile_picture',
        'status',
        'remarks',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
