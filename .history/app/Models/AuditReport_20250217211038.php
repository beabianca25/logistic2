<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'auditable_id',
        'auditable_type',
        'report_title',
        'report_details',
        'status',
        'location',
        'report_date',
    ];

    public function auditable()
    {
        return $this->morphTo();
    }

      // Notify users when a new report is generated
      public function sendNotification()
      {
          // Send notifications to admin or relevant users
          // For example: Notification::send($user, new AuditReportGenerated($this));
      }
}
