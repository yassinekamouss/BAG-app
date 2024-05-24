<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'title' ,
        'description',
        'prix' ,
        'categorie_id',
        'quantite',
        'image'
    ];
    
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function paniers()
    {
        return $this->belongsToMany(Panier::class, 'details_panier', 'produit_id', 'panier_id');
    }

    public function detailsPanier()
    {
        return $this->hasMany(Details_panier::class);
    }

    public function carModels()
    {
        return $this->belongsToMany(CarModel::class, 'car_model_produit', 'produit_id', 'carModel_id');
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'details_commandes')->withPivot('quantite');
    }
}
