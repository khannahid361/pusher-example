<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $post;
    public function __construct($post)
    {
        $this->post = $post;
    }


    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('posts'),
        ];
    }
     public function broadcastAs()
    {
        return 'create';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'message' => "[{$this->post->created_at}] New Post Received with title '{$this->post->title}'."
        ];
    }
}
