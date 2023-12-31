<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CellierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $celliers = Cellier::all()->where('user_id', Auth::user()->id);
        return view('celliers.index', ['celliers' => $celliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('celliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données
        $request->validate([
            'name'             => 'required|min:2|max:50',
            'description'      => 'nullable|min:2|max:500'
        ]);

        // Créer le cellier
        Cellier::create([
            'name'              => $request->name,
            'description'       => $request->description,
            'user_id'           => Auth::user()->id
        ]);

        return redirect('/celliers')->withSuccess("Votre cellier a été créé avec succès!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Cellier $cellier)
    {
        return view('celliers.show', ['cellier' => $cellier]);
    }

    /**
     * Affichage du formulaire pour modifier un cellier
     */
    public function edit(Cellier $cellier)
    {
        return view('celliers.edit', ['cellier' => $cellier]);
      }



      /**
     * Enregistrer les modifications de la table de la bd
     */
    public function update(Request $request, Cellier $cellier)
    {
 
        // Valider les données
         $request->validate([
        'name'             => 'required|min:2|max:50',
        'description'      => 'nullable|min:2|max:500'
                ]);
 
        $cellier->update([
          'name' => $request->name,
          'description' => $request->description
        ]);
 
        // return redirect(route('celliers.show', ['cellier' => $cellier]));
        return redirect("celliers/" . $cellier->id);
      }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellier $cellier)
    {
        $cellier->delete();
        return redirect('/celliers')->withSuccess("Votre cellier a été supprimé avec succès!");
    }
}


