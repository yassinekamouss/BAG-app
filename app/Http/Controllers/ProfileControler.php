<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileControler extends Controller
{
    /*
        * Afficher la page de profile :  
    */ 
    public function index(Request $request){
        //Recuperer l'utilisateur : 
        if (auth()->check()) {
            // Récupérer l'utilisateur authentifié
            $user = auth()->user();
            // Vérifier si l'utilisateur a la capacité de voir un profil d'utilisateur
            if($request->user()->can('view', $user)) {
                //Recuperer les commandes du client : 
                $commandes = $user->commandes()->orderBy('created_at', 'desc')->get(); ;
                // Retourner la vue avec les commandes récupérées
                return view ('users.profile.index' , compact('commandes'));
            }else {
                abort(403) ;
            }
        }
        abort(403);
    }
}