<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User ;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_de_livraison' => $this->faker->dateTimeBetween('now' , '+1 month')  , 
            'client_id' => User::factory()->create()->id ,
            'paiementMethod' => $this->faker->randomElement(['en ligne' , 'a la livraison']),
        ];
    }
}
