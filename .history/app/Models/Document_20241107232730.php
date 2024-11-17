<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    use HasFactory;

    protected $table = 'documents';
    protected $fillable = [
        'vendor_id', 
        'document_title', 
        'document_number', 
        'file_path', 
        'department', 
        'current_holder', 
        'purpose', 
        'status',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
