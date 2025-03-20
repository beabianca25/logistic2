<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcontractorRequirement extends Model
{
    use HasFactory;

    protected $table = 'subcontractor_requirements';

    protected $fillable = [
        'subcontractor_id', // Foreign key reference to subcontractors
        'estimated_cost',
        'preferred_payment_terms',
        'start_date_availability',
        'estimated_completion_time',
        'resources_required',
        'insurance_coverage',
        'certifications_or_licenses',
    ];

    // Define relationship with Subcontractor
    public function subcontractor()
    {
        return $this->belongsTo(Subcontractor::class);
    }
}
