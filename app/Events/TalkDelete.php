<?php

namespace App\Events;

use App\Models\Talk;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TalkDelete
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $talk;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Talk $talk)
    {
        $this->talk = $talk;
    }
}
