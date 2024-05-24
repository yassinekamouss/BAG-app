<?php

namespace App\Policies;

use App\Models\Categorie;
use App\Models\User;

class CategoriePolicy
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
    public function view(User $user, Categorie $categorie): bool
    {
        return true ;
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
    public function delete(User $user, Categorie $categorie): bool
    {
        return $user->email === 'admin@gmail.com' ;
    }
}
