<?php

namespace App\Notifications;

use App\Models\AuditReport;
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
        return (new MailMessage)
                    ->line('An audit report has been generated for ' . $this->report->auditable_type)
                    ->action('View Report', url('/audit-reports/' . $this->report->id));
    }
}
