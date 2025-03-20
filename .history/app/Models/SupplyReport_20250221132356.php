<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_id', 'report_title', 'report_details', 'status', 
        'document_status', 'submitted_at', 'description', 'location', 'report_date'
    ];
    

    public $timestamps = true;

    // Define the relationship with Supply
    public function supply()
    {
        return $this->belongsTo(Supply::class, 'supply_id');
    }

    // Define the relationship with Document

}
