<?php

namespace App\Events;

use App\Events\Event;
use App\Shout;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ShoutWasFired extends Event implements ShouldBroadcast
{
    use SerializesModels;
    /**
     * @var
     */
    public $shout;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param Shout $shout
     */
    public function __construct(Shout $shout)
    {
        $this->shout = $shout;
        $this->user = $this->shout->user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['shoutbox'];
    }

    public function broadcastWith()
    {
        return [
            'shout' => [
                'message' => $this->shout->shout,
                'username' => $this->user->username,
                'id' => $this->user->id,
                'name' => $this->user->name,
                'profile_pic' => $this->user->getProfilePicUrl(),
                'created_at' => $this->shout->created_at->diffForHumans(),
            ]
        ];
    }
}
