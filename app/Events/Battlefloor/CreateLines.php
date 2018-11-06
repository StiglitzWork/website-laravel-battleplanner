<?php

namespace App\Events\Battlefloor;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CreateLines implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lines;
    public $creator;
    public $identifier;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($lines, $identifier, $creator)
    {
        $this->lines = $lines;
        $this->identifier = $identifier;
        $this->creator = $creator;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('test-channel');
        return ['BattlefloorLine']; // TODO add room id!
    }
}
