<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'car_model_produit', 'carModel_id', 'product_id');
    }
}
