<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id'
    ];
   
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'details_panier', 'panier_id', 'produit_id');
    }
    public function detailsPanier()
    {
        return $this->hasMany(Details_panier::class);
    }
}
