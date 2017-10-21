<?php namespace LeadAssurance\Events;

use LeadAssurance\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use LeadAssurance\Models\User;

class UserSettingsChanged extends Event
{
    use SerializesModels;

    /**
     * @var User
     */
    public $user;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
