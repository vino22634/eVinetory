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
        //return $bouteilles;
        //return $bouteilles[1];

        return view('bouteilles.listRaw', ['bouteilles' => $bouteilles]);
        //return view('test.index', ['bouteilles' => $bouteilles]);

    }

    public function index()
    {
        $test = "moi";
        $bouteilles = Bouteille::with('userPreferences')->get();

        //$bouteilles = Bouteille::all();
        //return $bouteilles;
        //return $bouteilles[1];

        return view('bouteilles.list', ['bouteilles' => $bouteilles]);
        //return view('test.index', ['bouteilles' => $bouteilles]);

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
        // Sinon, ajouter la bouteille aux favoris
        else {
            $relation->favoris = 1;
            $relation->save();

            return response()->json(['message' => 'Bouteille ajoutée aux favoris']);
        }
    }

    // // public function helloworld(Request $request)
    // // {
    // //     $bouteille = Bouteille::find(11);

    // //     //return response()->json(['message' => $bouteille]);

    // //        $relation = BouteillePreferences::firstOrNew([
    // //        'bouteille_id' => $bouteille->id,
    // //        'user_id' => auth()->id(),
    // //        ]);
    // //     //\Log::info('Request Data: ', $request->all());
    // //             //$bouteille = Bouteille::findOrFail(11);
    // //               //return "hello";
    // //               //$relation = BouteillePreferences::firstOrNew([
    // //               //'bouteille_id' => $bouteille->id,
                  
    // //              // ]);

    // //     return response()->json(['message' => $relation]);

    // //     return response()->json(['message' => $relation]);
    // // }


    //  public function test()
    //  {
    //  $bouteille = Bouteille::find(11);

    //  //return response()->json(['message' => $bouteille]);

    //  $relation = BouteillePreferences::firstOrNew([
    //  'bouteille_id' => $bouteille->id,
    //  'user_id' => auth()->id(),
    //  ]);
    //  //\Log::info('Request Data: ', $request->all());
    //  //$bouteille = Bouteille::findOrFail(11);
    //  //return "hello";
    //  //$relation = BouteillePreferences::firstOrNew([
    //  //'bouteille_id' => $bouteille->id,

    //  // ]);

    //  return response()->json(['message' => "hello"]);

    //  return response()->json(['message' => $relation]);
    //  }
}
