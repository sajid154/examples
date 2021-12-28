<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendEmailToRegisteredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $res;
    /**
     * Create a new event instance.
     *
     * @return void
     */
       public function __construct($res)
    {
        // dd($res);
        $this->res = $res;
    }
}
