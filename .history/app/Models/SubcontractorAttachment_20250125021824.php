<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcontractorAttachment extends Model
{
    use HasFactory;

    // Define the table name (if different from the default plural form)
    protected $table = 'subcontractor_attachments';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'portfolio_samples',
        'business_licenses',
        'agreement_acknowledged',
        'signature',
        'submission_date',
    ];
}
