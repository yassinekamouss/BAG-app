<?php

namespace App\Events;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class sendNewCommandes implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $commande , $client ;
    public function __construct(Commande $commande , User $client)
    {
        $this->commande = $commande ;
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
            new PrivateChannel('newCommande.user.1'),
        ];
    }
    public function broadcastWith()
    {
        return ['commande' => $this->commande , 'client' => $this->client];
    }
    /**
     * Nommee l'event : 
    */
    public function broadcastAs(){
        return 'newCommande' ;
    }
}
