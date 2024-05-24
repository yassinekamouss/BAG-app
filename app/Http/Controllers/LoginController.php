<?php

namespace App\Http\Controllers;

use App\Events\sendNewClients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    // Affichage de la form de login : 
    public function showLoginForm(){
        return view('connecte.login');
    }
    //Affichage de la form de Sign In : 
    public function showSignupForm(){
        return view('connecte.sign');
    }
    //Traitement de login 
    public function login(Request $request)
    {
        $cridentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:10' 
        ]);
    
        if(Auth::attempt($cridentials)){
            // Rediriger vers la page d'accueil après l'authentification réussie
            $request->session()->regenerate();
            // Vérifier si l'utilisateur authentifié est un administrateur ou bien un utilisateur simple : 
            // return redirect()->route(Auth::user()->isAdmin() ? 'admin.index' : 'home');
            return Auth::user()->isAdmin() ? redirect()->route('admin.index') : redirect()->intended(route('home'));
        }
    
        // Rediriger vers la page de connexion en cas d'échec de l'authentification
        return redirect()->route('connecte.login.show')->withErrors([
            'password' => 'Email ou mot de passe incorrect' 
        ])->onlyInput('password');
    }    
    //Traitement de Signin
    public function signup(Request $request){
        //valider les donnees saisie par l'utilisateur : 
        $validatedForm = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:8|confirmed' 
        ]);
        $validatedForm['password'] = Hash::make($request->password) ;
        //in/serer les donnees dans la base de donnees : 
        $validatedForm['adresse'] = 'null';
        $validatedForm['n_tel'] = 'null';
        $validatedForm['role'] = 'admin';

        $client = User::create($validatedForm);
        // Déclenchez l'événement pour signaler qu'une nouvelle compte a été créée
        event(new sendNewClients($client));
        //et redireger l'utilisateur a la page de login
        return redirect()->route('connecte.login.show') ;
    }

    //Logout function : 
    public function logout(){
        //detruire la session : 
        Session::flush() ;
        Auth::logout() ;

        return redirect()->route('home');
    }
}
