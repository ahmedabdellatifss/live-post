<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class ChatMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $message;
    private User $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $message, User $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // public channel
        //return new Channel('public.chat.1');

        // private channel
        //return new PrivateChannel('private.chat.1');

        // presence channel
        return new PresenceChannel('presence.chat.1');
    }

    // to change the event name
    public function broadcastAs(){
        return 'chat-message';
    }

    // To attach data with event  to used by the frontend

    public function broadcastWith(){
        return[

            'message'=> $this->message,
            'user'=> $this->user->only(['name', 'email'])
        ];
    }


}
