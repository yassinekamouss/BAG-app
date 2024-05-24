<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit ;
use App\Models\Commande ;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DetailsCommandesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'commande_id' => Commande::pluck('id')->random(),
            'produit_id' => Produit::pluck('id')->random(),
            'quantite' => $this->faker->numberBetween(1, 10),
        ];
    }
}
