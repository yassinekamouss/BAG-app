<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str ;
use App\Models\Produit;
use App\Http\Requests\ProduitRequest;
use App\Models\CarModel;
use App\Models\Categorie;

class produitController extends Controller
{
    /**
     * Display a listing of the product.
     */
    public function index(Request $request)
    {
        //Tester si l'admin qui tente de recuperer tous les produits 
        if ($request->user() && $request->user()->can('viewAny', Produit::class)) {
            $produits = Produit::paginate(10);
            return view('admin.produits', compact('produits'));
        }
        return redirect()->route('home');
    }
    /**
     * Show the form for creating a new product.
     */
    public function create(Request $request)
    {
        //Tester si l'utilisateur a le droit de creer : 
        if ($request->user() && $request->user()->can('create', Produit::class)) {
            //Recuperer tous les categories et tous les car models : 
            $categories = Categorie::all();
            $carModels = CarModel::all(); ;
            return view('produits.create', compact(['categories' , 'carModels']));
        }
        return redirect()->route('home');
    }
    /**
     * Store a newly created product.
     */
    public function store(ProduitRequest $request)
    {
        // Tester si l'admin qui tente de créer un nouvel produit
        if ($request->user() && $request->user()->can('create', Produit::class)) {
            // Validation des données
            $validatedData = $request->validated();

            // Enregistrement de l'image si elle est présente
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('produits', 'public');
                $validatedData['image'] = $imagePath;
            }
            // Création du produit dans la base de données
            $produit = Produit::create($validatedData);

            // Enregistrement des relations avec les modèles de voitures
            $produit->carModels()->sync($request->input('cars_id'));

            // Redirection
            return redirect()->route('produits.index')->with('success', 'Le produit a été bien créé!');
        }
        
        return redirect()->route('home');
    }

    /**
     * Display the product.
     */
    public function show(Produit $produit)
    {
        // Recuperer les produits similaire : 
        $produits= Produit::where('categorie_id', $produit->categorie_id)
        ->where('id', '!=', $produit->id) // Exclure le produit affiché
        ->get();
        return view('produits.show' , compact(['produit' , 'produits']));
    }
    /**
     * Show the form for editing product.
     */
    public function edit(Produit $produit, Request $request)
    {
        if ($request->user() && $request->user()->can('update', Produit::class)) {
            //recuperer les categories et models de voitures : 
            $categories = Categorie::all();
            $carModels = CarModel::all() ;
            return view('produits.edite', compact(['produit' , 'categories' , 'carModels']));
        }
        return redirect()->route('home');
    }
    /**
     * Update the product in storage.
     */
    public function update(ProduitRequest $request, Produit $produit)
    {
        //Tester si l'admin qui tente de modifier : 
        if ($request->user() && $request->user()->can('update', $produit)) {
            //validation de donnees :
            $validatedData = $request->validated();
            $produit->fill($validatedData);
            if($request->hasFile('image')){
                $produit['image'] = $request->file('image')->store('produits' , 'public');
            }
            //Enregistrer les modifications dans la bdd : 
            $produit->save();
            // Mettre à jour les relations avec les modèles de voitures
            $produit->carModels()->sync($request->input('cars_id'));
            //redirection : 
            return redirect()->route('produits.index')->with('success', 'Le produit a été bien modifie!');
        }
        return redirect()->route('home');
    }
    /**
     * Remove the product from storage.
     */
    public function destroy(Produit $produit, Request $request)
    {
        //Tester si l'admin qui tente de modifier : 
        if ($request->user() && $request->user()->can('delete', $produit)) {
            //supprimer de la base de donnees :
            $produit->delete();
            return redirect()->route('produits.index')->with('success', 'le produits a ete bien supprimer');
        }
        return redirect()->route('home');
    }


    /********************************** fonction de recherche de produits'par nom'********************/
    public function search(Request $request) {
        // Si la requête provient de la page d'administration
        if ($request->has('source') && $request->source === 'admin') {
            // Recherche avec pagination
            if ($request->has('name') && $request->filled('name')) {
                $produits = Produit::where('title', 'LIKE', $request->name . '%')->paginate(10);
            } else {
                $produits = Produit::paginate(10);
            }
    
            $output = '';
            if ($produits->count() > 0) {
                foreach ($produits as $produit) {
                    $output .= '<tr>';
                    $output .= "<th>{$produit->id}</th>";
                    $output .= "<td>" . Str::limit($produit->title, 20) . "...</td>";
                    $output .= "<td><img src='" . asset('storage/'.$produit->image) . "' alt='' style='width: 100px; height: 60px; object-fit: fill;'></td>";
                    $output .= "<td>" . Str::limit($produit->description, 20) . "...</td>";
                    $output .= "<td>{$produit->prix}Dh</td>";
                    $output .= "<td>{$produit->quantite}</td>";
                    $output .= "<td>{$produit->categorie->name}</td>";
                    $output .= "<td>{$produit->created_at}</td>";
    
                    // Formulaire de suppression
                    $output .= '<td><form action="' . route("produits.destroy", $produit->id) . '" method="POST" class="delete-form">';
                    $output .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                    $output .= '<input type="hidden" name="_method" value="DELETE">';
                    $output .= '<button class="border-0 bg-transparent" type="submit"><i class="fs-5 text-danger fa-solid fa-trash"></i></button>';
                    $output .= '</form></td>';
    
                    // Icône de modification du produit
                    $output .= '<td>';
                    $output .= "<a href='" . url("produits/{$produit->id}/edit") . "'>";
                    $output .= '<i class="fs-5 text-success fa-solid fa-pen-to-square"></i>';
                    $output .= "</a>";
                    $output .= '</td>';
                    $output .= '</tr>';
                }
            } else {
                $output = "<tr><td colspan='8'>Aucune commande trouvée</td></tr>";
            }
    
            // Retourner les résultats en JSON pour l'administration
            return response()->json([
                'output' => $output,
                'total' => $produits->total()
            ]);
        } else {
            // Recherche pour la page front-end
            if ($request->has('name') && $request->filled('name')) {
                $produits = Produit::where('title', 'LIKE', $request->name . '%')->get();
            } else {
                $produits = collect();
            }
    
            $output = '';
            if ($produits->count() > 0) {
                $output .= "<div class='list-group rounded-3 mt-2 overflow-y-scroll' style='max-height: 700px;'>";
                foreach ($produits as $produit) {
                    $output .= "<a href=\"/produits/{$produit->id}\" class=\"list-group-item list-group-item-action text-decoration-none\">";
                    $output .= $produit->title;
                    $output .= "</a>";
                }
                $output .= "</div>";
            } else {
                $output .= '<div class="list-group"><div class="list-group-item">No data found</div></div>';
            }
    
            return $output;
        }
    }
    

}
