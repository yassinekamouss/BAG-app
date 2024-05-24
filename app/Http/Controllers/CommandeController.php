<?php

namespace App\Http\Controllers;

use App\Events\sendNewCommandes;
use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\Details_commandes;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf ;

class CommandeController extends Controller
{
    /*
        *Affichage de toutes les commande dans la page d'admin: 
    */ 
    public function index(Request $request){
        //Tester s'il est admin : 
        if ($request->user() && $request->user()->can('viewAny' , Commande::class)){
            //recuperer les commandes realiser : 
            $commandes = Commande::latest()->paginate(15);
            return view('admin.commandes' , compact('commandes'));
        }
        return redirect()->route('home');
    }
    /*
        *Stocker la commande : 
    */
    public function store(Request $request){
        //Test si la requete vient de la page de paiement : 
        if($request->command_a_enregistrer){
            //creer la commande : 
            $commande = Commande::create([
                'date_de_livraison' => Carbon::now()->addDays(30),
                'client_id' => session()->get('client_id'),
                'paiementMethod' => session()->get('paiementMethod')
            ]);
            //Recuperer le client qui a effectuer la commande : 
            $client = $commande->client ;
            //Tester si plus d'un seule produit : 
            if(session()->has('produits')){
            /**
                * Traitement dans le cas d'une achat d'un seule produit : 
            */ 
                $produitsSerialize = session()->get('produits');
                $produits = unserialize($produitsSerialize);
                if($commande){
                    foreach($produits as $produit){
                        //creer les lignes de commande et les affecter a la commande cree : 
                        Details_commandes::create([
                            'commande_id' => $commande->id ,
                            'produit_id' => $produit['produit']['id'] , 
                            'quantite' => $produit['quantite'] ,
                        ]);
                        //changer la quantite dans le stock : 
                        $this->changeQantite($produit['produit']['id'], $produit['quantite']);
                    }   
                    // Déclenchez l'événement pour signaler qu'une nouvelle commande a été créée
                        event(new sendNewCommandes($commande , $client));
                    // Redirigez l'utilisateur vers sa page de profil
                        return redirect()->route('users.profile')->with('success' , 'Commande a été bien effectué');
                }
            }
            /**
                * Traitement dans le cas d'une achat d'un seule produit : 
            */ 
                Details_commandes::create([
                    'commande_id' => $commande->id ,
                    'produit_id' => session()->get('produit')->id , 
                    'quantite' => session()->get('quantite') ,
                ]);
                //changer la quantite dans le stock : 
                $this->changeQantite(session()->get('produit')->id , session()->get('quantite'));
                // Déclenchez l'événement pour signaler qu'une nouvelle commande a été créée
                    event(new sendNewCommandes($commande , $client));
                // Redirigez l'utilisateur vers sa page de profil
                    return redirect()->route('users.profile')->with('success' , 'Commande a été bien effectué');
        }
        return abort(403) ;
    }
    /*
        *Affichage du details de commande pour modification(page d'admin)
    */ 
    public function edit(Commande $commande , Request $request){
        //Tester si l'utilisateur a les privillige pour la creation d'une commande : 
        if($request->user() && $request->user()->can('update' , $commande)){
            return view('commandes.edite' , compact('commande'));
        }
        return back();
        // return redirect()->route('home'); 
    }
    public function update(Commande $commande , Request $request){
        //Tester si l'utilisateur a les privillige pour la creation d'une commande : 
        if($request->user() && $request->user()->can('update' , $commande)){
            $commande->etat = $request->etat ;
            if($request->etat === 'Annulée'){
                foreach($commande->produits as $produit){
                    $produit->quantite += $produit->pivot->quantite ; 
                    $produit->save() ;
                }
            }
            //Enregistrer les modifications dans la bdd : 
            $commande->save();
            //redirection 
            return redirect()->route('commandes.index')->with('success' , 'L\'etat de la commande a été bien modifie!');
        }
        return back();
    }
    /*
        * fonction de suppression d'une commande : 
    */
    public function destroy(string $id , Request $request){
        $commande = Commande::findOrFail($id);
        //Tester si l'utilisateur a les privillige pour la creation d'une commande : 
        if($request->user() && $request->user()->can('delete',$commande)){
            $commande->delete();
            return redirect()->route('commandes.index')->with('success' , 'la commande a ete bien supprimer');
        }
        return redirect()->route('home'); 
    }

    /*
        * Fonction pour reduire la quantite apres la confirmation d'une commande : 
    */ 
    public function changeQantite($id , $quantite){
        //Recuperer le produit : 
        $produit = Produit::findOrFail($id);
        $produit->quantite -= $quantite ;
        $produit->save();
    }

    /*
        * Fonction pour telechargement de PDF du details de la commande : 
    */ 
    public function generatePDF(Request $request){
        //recuperer la commande :
        $commande = Commande::findOrFail($request->id);
        $pdf = Pdf::loadView('commandes.pdf' , compact('commande'));
        // return $pdf->download('commandes.pdf');
        return $pdf->stream('commandes.pdf');
    }

/********************************** fonction de recherche de produits'par nom'**********************************/
public function search(Request $request){
    // Vérifier si une valeur de recherche est présente
    if($request->has('code') && $request->filled('code')) {
        // Récupérer les commandes correspondantes à la recherche
        $commandes = Commande::where('id' , 'LIKE' , $request->code .'%')->paginate(15); // Vous pouvez ajuster le nombre d'éléments par page selon vos besoins
    } else {
        // Aucune valeur de recherche présente, renvoyer toutes les commandes
        $commandes = Commande::latest()->paginate(15); // Vous pouvez ajuster le nombre d'éléments par page selon vos besoins
    }

    // Générer la vue pour les commandes
    $output = '';
    if($commandes->count() > 0){
        foreach($commandes as $commande){
            //calcule du total de la commande : 
            $total = 0 ;
            foreach($commande->produits as $produit){
                $total += $produit->prix * $produit->pivot->quantite ;
            }
            $output .= '<tr>';
                //details de la commande : 
                $output .= "<th>$commande->id</th>";
                $output .= "<td>$commande->created_at</td>";
                $output .= "<td>$commande->date_de_livraison</td>";
                $output .= "<td>" . $commande->client->email . "</td>";
                $output .= "<td>$commande->etat</td>";
                $output .= "<td>" . $total . "DH</td>";
                //form de suppression :
                $output .= '<td><form action="' . route("commandes.destroy", $commande->id) . '" method="POST" class="delete-form">';
                    $output .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                    $output .= '<input type="hidden" name="_method" value="DELETE">';
                    $output .= '<button class="border-0 bg-transparent" type="submit"><i class="fs-5 text-danger fa-solid fa-trash" ></i></button>';
                $output .= '</form></td>';
                //l'icon de modification de la commande : 
                $output .= '<td>';
                    $output .= "<a href='" . url("produits/{$commande->id}/edit") . "'>";
                        $output .= '<i class="fs-5 text-success fa-solid fa-eye"></i>';
                    $output .= "</a>"; 
                $output .= '</td>';
            $output .= '</tr>';
        }
    }else{
        $output = "<tr><td colspan='8'>Aucune commande trouvée</td></tr>";
    }

    return response()->json([
        'output' => $output,
        'total' => $commandes->total()
    ]);
}
}