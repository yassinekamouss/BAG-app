<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB ;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        $produits = Produit::count();
        $categories = Categorie::count();
        $users = User::latest()->get();
        $commandes = Commande::latest()->get() ;
    
        // Récupérer les commandes avec paiement en ligne
        $commandesEnLigneParJour = Commande::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day'),
            DB::raw('COUNT(*) as total')
        )
        ->where('paiementMethod', 'en ligne')
        ->groupBy('year', 'month', 'day')
        ->orderBy('year', 'ASC')
        ->orderBy('month', 'ASC')
        ->orderBy('day', 'ASC')
        ->get();
    
        // Récupérer les commandes avec paiement à la livraison
        $commandesALaLivraisonParJour = Commande::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day'),
            DB::raw('COUNT(*) as total')
        )
        ->where('paiementMethod', 'a la livraison')
        ->groupBy('year', 'month', 'day')
        ->orderBy('year', 'ASC')
        ->orderBy('month', 'ASC')
        ->orderBy('day', 'ASC')
        ->get();
    
        return view('admin.accueil', [
            'produits' => $produits,
            'categories' => $categories,
            'users' => $users,
            'commandes' => $commandes ? $commandes : [],
            'commandesEnLigneParJour' => $commandesEnLigneParJour,
            'commandesALaLivraisonParJour' => $commandesALaLivraisonParJour,
        ]);
    }
}
