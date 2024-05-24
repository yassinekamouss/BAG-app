<?php

namespace App\Http\Controllers;

use App\Models\Details_panier;
use Illuminate\Support\Facades\Auth ;
use App\Models\Produit;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    protected $panier ;
    public function __construct()
    {
        // Exécuter l'instruction pour créer un panier pour l'utilisateur
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if ($user) {
                $this->panier = $user->panier()->firstOrCreate(['client_id' => $user->id]);
            }
            
            return $next($request);
        });
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            //Tester si le produit est deja existe dans le panier : 
            $existe = Details_panier::where ('produit_id' , $request->id)->where('panier_id' , $request->user()->panier->id)->first() ;
            if(empty($existe)){
                //Recuperer le produit : 
                $produit  = Produit::find($request->input('id'));
                // Creer une details_panier (produit_id et panier_id ):
                Details_panier::create([
                    'produit_id' => $produit->id ,
                    'panier_id' => Auth::user()->panier->id,
                    'quantite' => $request->quantite ? $request->quantite : 1
                ]);            
                return redirect()->route('paniers.show');
            }
            return back() ;
        }
        return redirect()->route('connecte.login.show');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
            $user = Auth::user();
            // Assurez-vous que l'utilisateur a un panier, sinon créez-en un
            $panier = $this->panier ;

            // Récupérer les produits associés au panier de l'utilisateur
            $details_panier = $panier->detailsPanier ;
            //Recuperer des produits de suggestion : 
            $produits = Produit::paginate(12) ;

            return view('paniers.show', compact(['details_panier' , 'produits']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $details_panier)
    {
        //Recuperer le panier d'utilisateur : 
        if(Auth::check()){
            $details = Details_panier::where('id' , $details_panier)->firstOrFail() ;
            $details->quantite = $request->quantite ;
            //Enregistrer les changement dans la BDD : 
            $details->save() ;
        }
        return redirect()->route('paniers.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $details_panier)
    {
        if(Auth::check()){
            $element = Details_panier::where('id' , $details_panier)
                        ->firstOrFail();
            //supprimer l'element : 
            $element->delete();
            return redirect()->route('paniers.show');
        }
        return back() ;
    }
}