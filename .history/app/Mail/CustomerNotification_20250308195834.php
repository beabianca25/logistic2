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
    public function __construct($subject, $messageBody)
    {
        $this->subject = $subject;
        $this->messageBody = $messageBody;
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
