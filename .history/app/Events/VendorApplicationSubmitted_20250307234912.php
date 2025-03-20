<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VendorApplicationSubmitted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pendingVendorCount;

    public function __construct($pendingVendorCount)
    {
        $this->pendingVendorCount = $pendingVendorCount;
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