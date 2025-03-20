<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcontractor extends Model
{
    use HasFactory;

    protected $table = 'subcontractors';

    protected $fillable = [
        'subcontractor_name',
        'business_registration_number',
        'contact_person',
        'business_address',
        'phone',
        'email',
        'website',
        'services_offered',
        'relevant_experience',
    ];

    // Relationships

    public function requirements()
    {
        return $this->hasMany(SubcontractorRequirement::class);
    }

    public function attachments()
    {
        return $this->hasMany(SubcontractorAttachment::class);
    }
}
