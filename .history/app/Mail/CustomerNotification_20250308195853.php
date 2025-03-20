<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageBody;
    public $attachment;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $messageBody, $attachment = null)
    {
        $this->subject = $subject;
        $this->messageBody = $messageBody;
        $this->attachment = $attachment;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.notification')
                    ->with([
                        'messageBody' => $this->messageBody,
                    ]);
    }
}
