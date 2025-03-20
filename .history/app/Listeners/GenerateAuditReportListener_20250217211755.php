<?php

namespace App\Listeners;

use App\Events\GenerateAuditReport;
use App\Models\AuditReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateAuditReportListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(GenerateAuditReport $event)
    {
        $model = $event->model;

        // Create the audit report based on the type of model (Supply or Asset)
        $report = AuditReport::create([
            'auditable_id' => $model->id,
            'auditable_type' => get_class($model),
            'report_title' => 'Audit Report for ' . $model->name,
            'report_details' => 'This is the audit report for the ' . get_class($model) . ' named ' . $model->name,
            'status' => 'Pending Review',
            'report_date' => now(),
        ]);

        // Optionally notify users about the report
        $report->sendNotification();
    }
}
