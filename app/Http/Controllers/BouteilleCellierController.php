<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BouteilleCellier;
use App\Models\Bouteille;
use App\Models\Cellier;
use Illuminate\Support\Facades\Auth;

class BouteilleCellierController extends Controller
{

    protected $fillable = [
        'id',
        'quantite',
        'created_at',
        'updated_at',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    //////////////////////////////////////////
    // AJAX methods


    /**
     * add the specified resource in storage.
     */
    public function add(Request $request)
    {
        $idBouteille = $request->input('idBouteille');
        $idCellier = $request->input('idCellier');
        $idUser = $request->input('idUser');
        $quantite = $request->input('qantite', 0); // je met a zero si aucune valeur


        // Vérifiez si il y a deja un item dans le cellier
        $bouteilleCellier = BouteilleCellier::where('id_bouteille', $idBouteille)
            ->where('id_cellier', $idCellier)
            ->first();

        if ($bouteilleCellier) {
            // Si l'association existe, mettez à jour la quantité
            $bouteilleCellier->quantite += $quantite;
            $bouteilleCellier->save();
        } else {
            // Sinon, créez une nouvelle association
            $bouteilleCellier = new BouteilleCellier([
                'id_bouteille' => $idBouteille,
                'id_cellier' => $idCellier,
                'id_user' => $idUser,
                'quantite' => $quantite
            ]);
            $bouteilleCellier->save();
        }

        return response()->json(['success' => true, 'message' => 'Bouteille ajoutée au cellier avec succès']);
    }
    /**
     * delete the specified resource in storage.
     */
    public function delete(Request $request)
    {
        $bouteilleCellierId = $request->input('id');
        $bouteilleCellier = BouteilleCellier::find($bouteilleCellierId);
        if ($bouteilleCellier) {
            $bouteilleCellier->delete();
            return response()->json(['success' => true, 'message' => 'BouteilleCellier deleted successfully']);
        }

        return response()->json(['success' => false, 'message' => 'BouteilleCellier not found'], 404);
    }


    public function saveAmount(Request $request)
    {
        $bouteilleCellierId = $request->input('id');
        $newAmount = $request->input('amount');

        // recupérer la bouteille
        $bouteilleCellier = BouteilleCellier::find($bouteilleCellierId);

        if ($bouteilleCellier && $newAmount >= 0) {
            // Mettre à jour la quantité
            $bouteilleCellier->quantite = $newAmount;
            $bouteilleCellier->save();

            return response()->json(['success' => true, 'message' => 'Quantité mise à jour avec succès']);
        }

        return response()->json(['success' => false, 'message' => 'Errur (quantité ou ID)']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    // Générer une vue pour la gestion de l'inventaire d'une d'un cellier (bouteilleCellier)
    public function ajaxViewfor_ManageCellierByCellier(Request $request, $cellierId)
    {
        $cellier = Cellier::find($cellierId);
         
        return view('celliers.partials-celier_ManageInventory', compact('cellier'))->render();
    }
}
