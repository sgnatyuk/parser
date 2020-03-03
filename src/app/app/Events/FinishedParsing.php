<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FinishedParsing extends Event implements ShouldBroadcast
{
    public $data;

    public function __construct(array $posts)
    {
        $this->data = $posts;
    }

    public function broadcastOn()
    {
        return new Channel('app');
    }
}
