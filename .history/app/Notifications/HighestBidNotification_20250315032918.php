<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Bid;

class HighestBidNotification extends Notification
{
    use Queueable;

    protected $bid;

    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Auction Ended - Highest Bid Notification')
            ->greeting('Hello Admin,')
            ->line('The auction for "' . $this->bid->auction->auction_title . '" has ended.')
            ->line('The highest bid was: $' . number_format($this->bid->bid_amount, 2))
            ->line('Bidder: ' . ($this->bid->user ? $this->bid->user->name : 'Guest'))
            ->action('View Auction', url('/auction/' . $this->bid->auction->id))
            ->line('Thank you for managing the auctions.');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Auction "' . $this->bid->auction->auction_title . '" has ended. Highest bid: $' . number_format($this->bid->bid_amount, 2),
            'bid_amount' => $this->bid->bid_amount,
            'auction_id' => $this->bid->auction->id,
        ];
    }
}
