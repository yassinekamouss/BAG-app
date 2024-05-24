<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class sendNewClients implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $client ;
    public function __construct(User $client)
    {
        $this->client = $client ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('newClient.user.1'),
        ];
    }
    /**
       *Envoyer le nouveau client : 
    */
    public function broadcastWith()
    {
        return ['client' => $this->client];
    }
    /**
     * Nommee l'event : 
    */
    public function broadcastAs(){
        return 'newClient' ;
    }
}
