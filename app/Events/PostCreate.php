<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $post;

    /**
     * Create a new event instance.
     */
    public $broadcastQueue = null;
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * The channel on which the event is broadcast.
     */
    public function broadcastOn(): Channel
    {
        return new Channel('posts'); // public channel
    }

    /**
     * Custom event name for frontend.
     */
    public function broadcastAs(): string
    {
        return 'PostCreated';
    }

    /**
     * Data to send to frontend.
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->post->id,
            'title' => $this->post->title,
            'created_by' => $this->post->user->name ?? 'Unknown',
            'created_at' => $this->post->created_at->toDateTimeString(),
        ];
    }
}
