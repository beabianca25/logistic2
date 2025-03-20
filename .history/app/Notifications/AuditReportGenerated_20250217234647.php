<?php

namespace App\Notifications;

use App\Models\AuditReport;
use App\Models\Asset;
use App\Models\Supply;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AuditReportGenerated extends Notification
{
    public $report;

    public function __construct(AuditReport $report)
    {
        $this->report = $report;
    }

    public function via($notifiable)
    {
        return ['mail']; // You can use other channels like database
    }

    public function toMail($notifiable)
    {
        $auditableName = null;

        // Check if the report is related to an Asset or Supply
        if ($this->report->asset_id) {
            $asset = Asset::find($this->report->asset_id);
            $auditableName = $asset ? $asset->asset_name : 'Unknown Asset';
        } elseif ($this->report->supply_id) {
            $supply = Supply::find($this->report->supply_id);
            $auditableName = $supply ? $supply->supply_name : 'Unknown Supply';
        }

        return (new MailMessage)
                    ->line('An audit report has been generated for ' . $auditableName)
                    ->action('View Report', url('/audit-reports/' . $this->report->id));
    }
}
