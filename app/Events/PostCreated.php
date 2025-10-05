<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    // Public channel for all users (or customize for private channels)
    public function broadcastOn()
    {
        return new Channel('posts');
    }

    public function broadcastAs()
    {
        return 'PostCreated';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->post->id,
            'title' => $this->post->title,
            'created_by' => $this->post->user->name ?? 'Unknown',
            'created_at' => $this->post->created_at->toDateTimeString(),
        ];
    }
}
