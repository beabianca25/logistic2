<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcontractorRequirement extends Model
{
    use HasFactory;

    // Define the table name (if different from the default plural form)
    protected $table = 'subcontractor_requirements';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'estimated_cost',
        'preferred_payment_terms',
        'start_date_availability',
        'estimated_completion_time',
        'resources_required',
        'insurance_coverage',
        'certifications_or_licenses',
    ];
}
