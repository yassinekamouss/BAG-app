<?php

namespace App\Http\Controllers;

use App\Models\Categorie ;
use App\Models\Produit ;
use App\Http\Requests\CategorieRequest ;
use Illuminate\Http\Request;
use Illuminate\support\Str;

class categorieController extends Controller
{
    /**
     * Display a listing of the categorie.
     */
    public function index(Request $request){
        //tester s'il est un admin :
        if($request->user() && $request->user()->can('viewAny' , Categorie::class)){
            $categories = Categorie::withCount('produits')->paginate(10);
            return view('admin.categories' , compact('categories'));            
        }
        $categories = Categorie::all() ;
        $produits = Produit::latest()->paginate(18) ;
        return view('categories.index' , compact(['categories' , 'produits']));
    }

    /**
     * Show the form for creating a new categorie.
     */
    public function create(Request $request){
        //Tester s'il est admin : 
        if($request->user() && $request->user()->can('create' , Categorie::class)){
            return view('categories.create');            
        }
        return redirect()->route('home');
    }

    /**
     * Store a newly created categorie in storage.
     */
    public function store(CategorieRequest $request){
        //Tester si l'admin qui tente de creer : 
        if($request->user() && $request->user()->can('create' , Categorie::class)){
            //validation de donnees :
            $categorie = $request->validated() ;

            // Check if there is an image uploaded and store it into the public/categories folder : 
            if($request->hasFile('image')){
                $categorie['image'] = $request->file('image')->store('categories', 'public');
            }
            //creation dans la bdd : 
            Categorie::create($categorie) ;
            //redirection : 
            return redirect()->route('categories.index')->with('success', 'La categorie a été bien créé!');            
        }
        return redirect()->route('home');
    }

    /**
     * Display the categorie.
     */
    public function show(Categorie $categorie){
        //recuperer les produits : 
        $produits = $categorie->produits;
        return view('categories.show' , compact(['categorie' , 'produits'])) ;
    }

    /**
     * Show the form for editing the categorie.
     */
    public function edit(Categorie $categorie , Request $request){
        if ($request->user() && $request->user()->can('update', Categorie::class)) {
            return view('categories.edite' , compact('categorie'));
        }
        return redirect()->route('home');
    }

    /**
     * Update the categorie in storage.
     */
    public function update(CategorieRequest $request , Categorie $categorie){
        //Tester si l'admin qui tente de modifier : 
        if($request->user() && $request->user()->can('update' , $categorie)){
            //validation de donnees :
            $validatedData = $request->validated() ;
            $categorie->fill($validatedData);
            //Tester l'existance de l'image : 
            if($request->hasFile('image')){
                $categorie['image'] = $request->file('image')->store('categories', 'public');
            }
            //Enregistrer les modifications dans la bdd : 
            $categorie->save() ;
            //redirection : 
            return redirect()->route('categories.index')->with('success', 'La categorie a été bien modifie!');            
        }
        return redirect()->route('home');
    }

    /**
     * Remove the categorie from storage.
     */
    public function destroy(Categorie $categorie , Request $request){
        //Tester s'il est un admin : 
        if($request->user() && $request->user()->can('delete' , $categorie)){
            //supprimer de la base de donnees :
            $categorie->delete() ;
            return redirect()->route('categories.index')->with('success', 'la categorie a ete bien supprimer');
        }   
        return redirect()->route('home');  
    }


/********************************** fonction de recherche de produits'par nom'********************/
    public function search(Request $request) {
        // Recherche avec pagination
        if ($request->has('name') && $request->filled('name')) {
            $categories = Categorie::where('name', 'LIKE', $request->name . '%')->paginate(10);
        } else {
            $categories = Categorie::paginate(10);
        }

        $output = '';
        if ($categories->count() > 0) {
            foreach ($categories as $categorie) {
                $output .= '<tr>';
                    $output .= "<th>{$categorie->id}</th>";
                    $output .= "<td>$categorie->name</td>";
                    $output .= "<td><img src='" . asset('storage/'.$categorie->image) . "' alt='' style='width: 100px; height: 50px; object-fit: cover;'></td>";
                    $output .= "<td>" . Str::limit($categorie->description, 30) . "...</td>";
                    $output .= "<td>{$categorie->produits_count}</td>";
                    $output .= "<td>{$categorie->created_at}</td>";
    
                    // Formulaire de suppression
                    $output .= '<td><form action="' . route("categories.destroy", $categorie->id) . '" method="POST" class="delete-form">';
                    $output .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                    $output .= '<input type="hidden" name="_method" value="DELETE">';
                    $output .= '<button class="border-0 bg-transparent" type="submit"><i class="fs-5 text-danger fa-solid fa-trash"></i></button>';
                    $output .= '</form></td>';
    
                    // Icône de modification du produit
                    $output .= '<td>';
                    $output .= "<a href='" . url("categories/{$categorie->id}/edit") . "'>";
                    $output .= '<i class="fs-5 text-success fa-solid fa-pen-to-square"></i>';
                    $output .= "</a>";
                    $output .= '</td>';
                $output .= '</tr>';
            }
        } else{
            $output = "<tr><td colspan='8'>Aucune commande trouvée</td></tr>";
        }
        return response()->json([
            'output' => $output ,
            'total' => $categories->total()
        ]);
    }
}