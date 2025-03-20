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
        'service_vendor_contact',
        'labor_cost',
        'parts_cost',
        'total_cost',
        'parts_replaced',
        'odometer_reading',
        'warranty_period',
        'next_service_due',
        'issue_reported',
        'issue_fixed',
        'technician_name',
        'maintenance_notes',
        'maintenance_status',
        'approved_by',
    ];

    // Relationship with Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relationship with User (Approver)
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
