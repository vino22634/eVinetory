<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BouteilleCellier;

class BouteilleCellierController extends Controller
{
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
}
