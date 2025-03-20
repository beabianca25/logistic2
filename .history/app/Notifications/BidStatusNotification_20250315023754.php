<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class BidStatusNotification extends Notification
{
    use Queueable;

    public $bid;

    /**
     * Create a new notification instance.
     */
    public function __construct($bid)
    {
        $this->bid = $bid;
    }

    /**
     * Determine the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database']; // Store notifications in the database
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'bid_id' => $this->bid->id,
            'auction_title' => $this->bid->auction->auction_title ?? 'Unknown Auction',
            'bid_amount' => $this->bid->bid_amount,
            'status' => $this->bid->status,
            'message' => "Your bid on '{$this->bid->auction->title}' is now '{$this->bid->status}'.",
        ];
    }
}
