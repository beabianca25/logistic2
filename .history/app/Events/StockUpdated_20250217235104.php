<?php

namespace App\Events;

use App\Models\Supply;
use App\Models\Asset; // Make sure to include the Asset model
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $asset;
    public $supply;

    /**
     * Create a new event instance.
     *
     * @param Asset|null $asset
     * @param Supply|null $supply
     */
    public function __construct(Asset $asset = null, Supply $supply = null)
    {
        $this->asset = $asset;
        $this->supply = $supply;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('stock-updated'), // Example of using a custom channel
        ];
    }
}
