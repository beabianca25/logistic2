<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcontractor extends Model
{
    use HasFactory;

    protected $table = 'subcontractors';
    protected $fillable = [
        'subcontractor_name',
        'project_scope',
        'cost_estimate',
        'timeline',
        'resources_required',
        'contact_information',
        'status',
        'submitted_date',
    ];
}
