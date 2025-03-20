<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class VendorApplicationSubmitted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pendingVendorCount;
    public $message;

    public function __construct($pendingVendorCount, $vendorName)
    {
        $this->pendingVendorCount = $pendingVendorCount;
        $this->message = "New vendor application submitted: $vendorName";

          // **Store the notification in the database**
        //   Notification::create([
        //     'message' => $this->message,
        //     'status' => 'unread'
        // ]);
    }

    public function broadcastOn()
    {
        return new Channel('vendor-channel');
    }

    public function broadcastAs()
    {
        return 'vendor.application.submitted';
    }
}
