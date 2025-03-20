<?php

namespace App\Events;

use App\Models\Supply;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SupplyStockChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $supply;
    public $quantityChanged;
    public $action; // 'increase' or 'decrease'

      /**
     * Create a new event instance.
     *
     * @param Supply $supply
     * @param int $quantityChanged
     * @param string $action
     */
    public function __construct(Supply $supply, int $quantityChanged, string $action)
    {
        $this->supply = $supply;
        $this->quantityChanged = $quantityChanged;
        $this->action = $action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
