<?php

namespace App\Events;

use App\Models\Discution\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;   

    /**
     * Message details
     *
     * @var Message
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }
    public function broadcastWith()
    {
        return [
            'message' => $this->message->load([
                'from' =>function($query){
                    $query->select('id', 'pseudo');
                }
            ])->toArray()
        ];
    }
    /*public function broadcastAs(){
        return 'NewMessage';
        return [
            'message' => $this->message->load([
                'from' =>function($query){
                    $query->select('id', 'pseudo');
                }
            ])->toArray()
        ];
    }*/
}
