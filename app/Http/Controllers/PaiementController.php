<?php

namespace App\Http\Controllers;

require_once base_path('vendor/autoload.php');

use Illuminate\Http\Request;
use App\Models\Produit;

class PaiementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
        *Checkout page : 
    */ 
    public function checkout(Request $request)
    {
        session()->forget(['produits' , 'produit' , 'total' , 'quantite']);
        // Vérifier si le panier est présent dans la requête
        if ($request->has('panierDetails')) {
            // Si des détails de panier sont présents, traitement pour plusieurs produits
            $produits = json_decode($request->panierDetails, true);
            session()->put('produits', serialize($produits));
            session()->put('total', $request->prix);
            return view('paiement.checkout', compact('produits'));
        }
    
        // Sinon, traitement pour un seul produit
        $produit = Produit::find($request->id);
        $quantite = $request->quantite;
        // Stocker le prix et la quantité dans la session
        session()->put('quantite', $quantite);
        session()->put('total', $request->prix * $quantite);
        session()->put('produit', $produit);
        return view('paiement.checkout', compact('produit'));
    }

    /*
        * confirmation page : 
    */
    public function confirm(Request $request)
    {
        session()->forget(['nom', 'prenom', 'ville', 'adresse', 'postCode', 'n_tel', 'email', 'paiementMethod']);
        session()->put('client_id' , auth()->user()->id);
        session()->put('nom', $request->nom);
        session()->put('prenom', $request->prenom);
        session()->put('ville', $request->ville);
        session()->put('adresse', $request->adresse);
        session()->put('postCode', $request->postCode);
        session()->put('n_tel', $request->n_tel);
        session()->put('email', $request->email);
        session()->put('paiementMethod', $request->paiementMethod);

        // Vérifier s'il s'agit d'un seul produit ou de plusieurs produits depuis le panier
        if (session()->has('produits')) {
            // Si c'est le cas, récupérez les produits depuis la session et traitez-les
            $produitsSerialize = session()->get('produits');
            $produits = unserialize($produitsSerialize);
            return view('paiement.confirm', compact('produits'));
        } else {
            // Sinon, s'il s'agit d'un seul produit, récupérez-le depuis la session et traitez-le
            $produit = session()->get('produit');
            return view('paiement.confirm', compact('produit'));
        }
    }
    
    /*
        *Traitement de la commande: 
    */
    public function traitement(Request $request)
    {

        if (session()->get('paiementMethod') === 'En ligne') {

            \Stripe\Stripe::setApiKey('sk_test_51P97jdP3a7Bg0JjeuXfDhcRufawXsOsaBUgF2yTC8ABLS9zPTkovar56XwhfHkqFV7HZHQF6R9LI1uWpxtGowdES00jd6D6g04');
            $session = \Stripe\Checkout\Session::create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'mad',
                            'product_data' => [
                                'name' => 'Completez l\'achat des articles , Avec un prix total',
                            ],
                            'unit_amount' => session()->get('total') * 100,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('commandes.store' , ['command_a_enregistrer' => 'true']),
            ]);
            return redirect()->away($session->url);
        } else {
            return redirect()->route('commandes.store' , ['command_a_enregistrer' => 'true']);
        }
    }
}
