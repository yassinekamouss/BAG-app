<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_de_livraison',
        'client_id' ,
        'paiementMethod' ,
    ];

    public function client(){
        return $this->belongsTo(User::class) ;
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'details_commandes')->withPivot('quantite');
    }
}
