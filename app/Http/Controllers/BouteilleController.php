<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bouteille;

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
        $bouteilles = Bouteille::all();
        //return $bouteilles;
        //return $bouteilles[1];

        return view('bouteilles.list', ['bouteilles' => $bouteilles]);
        //return view('test.index', ['bouteilles' => $bouteilles]);

    }
}
