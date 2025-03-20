<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcontractorAttachment extends Model
{
    use HasFactory;

    protected $table = 'subcontractor_attachments';

    protected $fillable = [
        'subcontractor_id', // Foreign key reference to subcontractors
        'portfolio_samples', // File path or description of portfolio samples
        'business_licenses', // File path for business licenses
        'agreement_acknowledged', // Boolean to confirm agreement acknowledgment
        'signature', // Digital signature or file path
        'submission_date', // Date of submission
    ];

    // Define relationship with Subcontractor
    public function subcontractor()
    {
        return $this->belongsTo(Subcontractor::class);
    }
}
