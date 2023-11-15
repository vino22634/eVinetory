<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bouteille;
use App\Models\BouteillePreferences;
use App\Models\PastilleType;
use App\Models\Cellier;

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
        $bouteilles = Bouteille::with('userPreferences')->with('pastilleType')->paginate(20);

        $celliers = Cellier::all();
        //return $bouteilles;
        return view('bouteilles.list', ['bouteilles' => $bouteilles, 'celliers' => $celliers]);
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

    // récupérer les bouteilles en ajax
    public function ajaxLoadMoreBouteilles(Request $request)
    {
        // Laravel connait la page grace au parametre 'page' de la requete
        if ($request->ajax()) {
            $bouteilles = $this->getBouteillesQuery($request)->paginate(20);
            return view('bouteilles.partials-bouteilleslist', compact('bouteilles'))->render();
        }
    }


    // generer une vue pour la gestion de l'inventaire d'une bouteille (bouteilleCellier)
    public function ajaxViewfor_ManageCellier(Request $request, $bouteilleId)
    {
        $bouteille = Bouteille::find($bouteilleId);
        $bouteilleCelliers = $bouteille->bouteilleCelliersForUser(auth()->id());
        $user = auth()->user();
        $celliers = $user->celliers;

        $mesCelliers = [];

        foreach ($celliers as $cellier) {
            $mesCelliers[$cellier->name] = [
                "instance" => $cellier,
                "contenu" => []
            ];
        }


        foreach ($bouteilleCelliers as $bouteilleCellier) {
            $nomCellier = $bouteilleCellier->cellier->name;
            $mesCelliers[$nomCellier]["contenu"][] = $bouteilleCellier;
        }

        // mettre un temporaty placeholder
        foreach ($mesCelliers as $nomCellier => $dataCellier) {
            if (empty($dataCellier['contenu'])) {
                $idCellierCourant = $dataCellier['instance']->id;

                $tempBouteilleCellier = new \App\Models\BouteilleCellier([
                    'id' => null,
                    'id_cellier' => $idCellierCourant,
                    'id_bouteille' => $bouteille->id, // Vous pouvez mettre null ou un ID de bouteille par défaut
                    'quantite' => 0
                ]);
                $mesCelliers[$nomCellier]["contenu"][] = $tempBouteilleCellier;
            }
        }

        return view('bouteilles.partials-bouteilles_ManageCellier', compact('mesCelliers'))->render();
    }



    public function search(Request $request)
    {
        $bouteilles = $this->getBouteillesQuery($request)->paginate(20);
        return view('bouteilles.partials-bouteilleslist', compact('bouteilles'));
    }


    protected function getBouteillesQuery(Request $request)
    {
        $query = $request->input('query');
        $ordreFull = $request->input('sort');
        //split mon item pour récupérer le champ et le sens
        $arrayorder = explode("__", $ordreFull);
        $ordreChamp = $arrayorder[0];
        $ordreSens = $arrayorder[1];

        $bouteillesQuery = Bouteille::query();

        if ($query) {
            $bouteillesQuery->where('nom', 'LIKE', '%' . $query . '%');
        }

        $bouteillesQuery->orderBy($ordreChamp, $ordreSens);
        return $bouteillesQuery;
    }

    /**
    * Afficher les détails d'une bouteille
    */
    public function show(Bouteille $bouteille)
    {
        $bouteilleDansCelliers = $bouteille->bouteilleDansCelliersUser();
        return view('bouteilles.show', ['bouteille' => $bouteille, 'bouteilleDansCelliers' => $bouteilleDansCelliers]);
    }
}
