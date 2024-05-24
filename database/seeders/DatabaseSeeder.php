<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Details_commandes ;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::factory(100)->create() ;
        // Générer des commandes factices
        Commande::factory()->count(2)->create()->each(function ($commande) {
            // Pour chaque commande, générer des détails de commande factices
            Details_commandes::factory()->count(3)->create(['commande_id' => $commande->id]);
        });
    }
}