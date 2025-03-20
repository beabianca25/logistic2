<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents'; // Table name

    protected $fillable = [
        'document_title',
        'file_path',
        'department',
        'current_holder',
        'purpose',
        'status',
        'extracted_text',
    ];

    // Status options
    public static function getStatusOptions()
    {
        return ['Pending', 'Approved', 'Rejected', 'Active', 'Inactive', 'Archived'];
    }

    // Accessor for status
    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    // Mutator to ensure status is stored in lowercase
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower($value);
    }
}
