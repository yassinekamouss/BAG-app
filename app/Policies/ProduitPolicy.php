<?php

namespace App\Policies;

use App\Models\Produit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProduitPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->email === 'admin@gmail.com' ;
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->email === 'admin@gmail.com' ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->email === 'admin@gmail.com' ;
    }
    
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Produit $produit): bool
    {
        return $user->email === 'admin@gmail.com' ;
    }
}
