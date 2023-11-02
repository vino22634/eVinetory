<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bouteille;
use App\Models\BouteillePreferences;
use Illuminate\Support\Facades\Auth;


class BouteilleController extends Controller
{
    public function indexRaw()
    {
        $bouteilles = Bouteille::all();
        return view('bouteilles.listRaw', ['bouteilles' => $bouteilles]);
    }

    public function index()
    {
        $test = "moi";
        $bouteilles = Bouteille::with('userPreferences')->get();
        return view('bouteilles.list', ['bouteilles' => $bouteilles]);
    }



    public function toggleFavorite(Request $request, $bouteilleId)
    {
        $bouteille = Bouteille::find($bouteilleId);
        $relation = BouteillePreferences::firstOrNew([
            'bouteille_id' => $bouteille->id,
            'user_id' => auth()->id(),
        ]);
        // Si la bouteille est déjà dans les favoris, la supprimer des favoris
        if ($relation->exists && $relation->favoris) {
            $relation->favoris = 0;
            $relation->save();
            return response()->json(['message' => 'Bouteille supprimée des favoris']);
        }
        // Sinon, ajouter la bouteille aux fav
        else {
            $relation->favoris = 1;
            $relation->save();
            return response()->json(['message' => 'Bouteille ajoutée aux favoris']);
        }
    }

    public function togglePurchase(Request $request, $bouteilleId)
    {
        $bouteille = Bouteille::find($bouteilleId);
        $relation = BouteillePreferences::firstOrNew([
            'bouteille_id' => $bouteille->id,
            'user_id' => auth()->id(),
        ]);
        // Si la bouteille est déjà dans les favoris, la supprimer des favoris
        if ($relation->exists && $relation->listeDachat) {
            $relation->listeDachat = 0;
            $relation->save();
            return response()->json(['message' => "Bouteille supprimée de liste d'achat"]);
        }
        // Sinon, ajouter la bouteille aux fav
        else {
            $relation->listeDachat = 1;
            $relation->save();
            return response()->json(['message' => "Bouteille ajoutée de liste d'achat"]);
        }
    }
}
