<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Commande ;

class CommandePolicy
{
/**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->email === 'admin@gmail.com' ;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Commande $commande): bool
    {
        return $user->email === 'admin@gmail.com' ;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user , Commande $commande): bool
    {
        return $user->email === 'admin@gmail.com' ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Commande $commande): bool
    {
        return $user->email === 'admin@gmail.com' ;
    }
}
