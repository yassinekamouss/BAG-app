<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModelProduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'carModel_id'
    ];
}
