<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Details_panier extends Model
{
    use HasFactory;

    protected $table = 'details_paniers';

    protected $fillable = [
        'produit_id',
        'panier_id',
        'quantite'
    ];

    public function panier()
    {
        return $this->belongsTo(Panier::class, 'panier_id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
