<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditReport extends Model
{
    use HasFactory;

    protected $fillable = ['auditable_id', 'auditable_type', 'report_title', 'report_details', 'status'];

    public function auditable()
    {
        return $this->morphTo();
    }
}
