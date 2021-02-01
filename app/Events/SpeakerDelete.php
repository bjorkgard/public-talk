<?php

namespace App\Events;

use App\Models\Speaker;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SpeakerDelete
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $speaker;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Speaker $speaker)
    {
        $this->speaker = $speaker;
    }
}
