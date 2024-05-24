<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest ;
use App\Models\User;
use Illuminate\Support\Facades\Hash ;

class UserController extends Controller
{
        /**
     * Display a listing of the product.
     */
    public function index(Request $request){
        //Tester si l'admin qui tente de recuperer les utilisateurs : 
        if($request->user() && $request->user()->can('viewAny' , User::class)){
            $users = User::paginate(15) ;
            return view('admin.users' , compact('users'));            
        }
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(Request $request){
            //Tester si l'admin qui tente de creer un nouvel utilisateur :
            if($request->user() && $request->user()->can('create' , User::class)){
                return view('users.create');
            }
            return redirect()->route('home');
    }
    /**
     * Store a newly created product.
     */
    public function store(UserRequest $request){
        //Tester si l'admin qui tente de creer: 
        if($request->user() && $request->user()->can('create' , User::class)){
            //validation de donnees :
            $user = $request->validated() ;
            //creation dans la bdd : 
            $user['password'] = Hash::make($user['password']) ;
            User::create($user) ;
            //redirection : 
            return redirect()->route('users.index')->with('success', 'Le profile a été bien créé!');            
        }
        return redirect()->route('home');
    }
    
    /**
     * Show the form for editing product.
     */
    public function edit(User $user , Request $request){
        //Testez si le compte est privé pour l'utilisateur :
        if($request->user() && $request->user()->can('update' , $user)){
            return view('users.edite' , compact('user'));
        }
        return redirect()->route('home');
    }
    /**
     * Update the product in storage.
     */
    public function update(Request $request , User $user){
        //Vérifier si le compte appartient à l'utilisateur  : 
        if($request->user() && $request->user()->can('update' , $user)){
            //validation de donnees :
            $validatedData = $request->validate([
                'nom' => 'required' ,
                'prenom' => 'required' ,
                'ville' => 'required' , 
                'adresse' => 'required',
                'email' => 'required|email' ,
                'n_tel' =>'required'
            ]);
            $user->fill($validatedData);

            //Enregistrer les modifications dans la bdd : 
            $user->save() ;
            //redirection : 
            return redirect()->route('users.profile')->with('success', 'La profile a été bien modifie!');    
        }
        return redirect()->route('home');
    }
    /**
     * Remove the product from storage.
     */
    public function destroy(User $user , Request $request){
        //Tester si l'admin qui tente de modifier OU l'utilisateur propritaire de profile : 
        if($request->user() && $request->user()->can('delete' , $user)){
            //supprimer de la base de donnees :
            $user->delete();
            //S'il est admin : 
            if($request->user()->isAdmin()){
                return redirect()->route('users.index')->with('success', 'le profile a ete bien supprimer');
            }
            return redirect()->route('users.show')->with('success', 'le profile a ete bien supprimer');            
        }
        return redirect()->route('home');
    }

    
/********************************** fonction de recherche de client'par email'**********************************/
public function search(Request $request){
    // Vérifier si une valeur de recherche est présente
    if($request->has('code') && $request->filled('code')) {
        // Récupérer les commandes correspondantes à la recherche
        $clients = User::where('email' , 'LIKE' , $request->code .'%')->paginate(15); // Vous pouvez ajuster le nombre d'éléments par page selon vos besoins
    } else {
        // Aucune valeur de recherche présente, renvoyer toutes les commandes
        $clients = User::paginate(15); // Vous pouvez ajuster le nombre d'éléments par page selon vos besoins
    }

    // Générer la vue pour les commandes
    $output = '';
    if($clients->count() > 0){
        foreach($clients as $client){
            $output .= '<tr>';
                //details du client : 
                $output .= "<th>$client->id</th>";
                $output .= "<td>$client->nom</td>";
                $output .= "<td>$client->prenom</td>";
                $output .= "<td>$client->email</td>";
                $output .= "<td>$client->ville</td>";
                $output .= "<td>$client->n_tel</td>";
                $output .= "<td>$client->created_at</td>";
                //form de suppression :
                $output .= '<td><form action="' . route("users.destroy", $client->id) . '" method="POST" class="delete-form">';
                    $output .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                    $output .= '<input type="hidden" name="_method" value="DELETE">';
                    $output .= '<button class="border-0 bg-transparent" type="submit"><i class="fs-5 text-danger fa-solid fa-trash" ></i></button>';
                $output .= '</form></td>';
            $output .= '</tr>';
        }
    }else{
        $output = "<tr><td colspan='8'>Aucune client trouvée</td></tr>";
    }

    return response()->json([
        'output' => $output,
        'total' => $clients->total()
    ]);
}
}