<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; //pour envoyer courriel

class ErrorController extends Controller
{
    //affichage formulaire error
   public function index(){
    return view("erreur.index");
   }

   public function sendEmail(Request $request){
        $subject = $request->input('subject');
        $body = $request->input('body');

        // Envoyer courriel logic en utilisant Laravel Mail
        mail('evinetory@gmail.com', $subject, $body);

        return redirect()->route('erreur.index')->with('success', 'Courriel envoyé! Merci!');
   }
}
