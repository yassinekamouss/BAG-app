<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact(){
        return view('contact.form');
    }
    public function send(Request $request){
        //validation des donnees recues : 
        $request->validate([
            'nom' => 'required' , 
            'email' => 'email|required' ,
            'sujet' => 'required' ,
            'message' => 'required'
        ]);
        Mail::to($request->email)->send(new ContactMailable($request->nom , $request->email , $request->sujet , $request->message));
        //faire en redirection avec un message de success : 
        return redirect()->back()->with('success' , 'Votre formulaire a ete bien recue . Merci');
    }
}