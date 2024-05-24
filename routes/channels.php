<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

//channel pour les new clients
Broadcast::channel('newClient.user.{id}' , function($user , $id){
    return $user->id == $id ;
});
//channel pour les new commandes
Broadcast::channel('newCommande.user.{id}' , function($user , $id){
    return (int) $user->id === (int) $id;
});