<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormEmail;

class ErrorController extends Controller
{
    // Affichage du formulaire de contact
    public function index()
    {
        return view('erreur.index');
    }

    // Traitement de l'envoi d'e-mails
    public function sendEmail(Request $request)
    {
        // Validation des données du formulaire 
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Récupération des données du formulaire
        $subject = $request->input('subject');
        $body = $request->input('body');

        // Envoi de l'e-mail
        try {
            // Remplacez avec vos propres données d'e-mail (destinataire, contenu, etc.)
            //  mail('evinetory@gmail.com', $subject, $body);
            Mail::to('evinetory@gmail.com')->send(new ContactFormEmail($subject, $body));

            // Redirection avec un message de succès
            return redirect()->route('profile.index')->with('message', 'Courriel envoyé avec succès! Merci!');
        } catch (\Exception $e) {
            // En cas d'erreur lors de l'envoi de l'e-mail
            return redirect()->route('profile.index')->with('message', 'Une erreur s\'est produite lors de l\'envoi du courriel.');
        }
    }
}
