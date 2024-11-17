<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_Request extends Model
{
    use HasFactory;

    // Define the table if it's not the plural of the model name
    protected $table = 'document_requests';

    // Allow mass assignment for these fields
    protected $fillable = [
        'requester_name',
        'request_date',
        'data_type',
        'description',
        'priority_level',
        'deadline',
        'status',
        'assigned_to',
        'completion_date',
        'comments'
    ];
}
