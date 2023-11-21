<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\BouteilleCellierController;
use App\Http\Controllers\ErrorController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('bouteilles.list');
    } else {
        return view('welcome');
    }
});


Route::middleware('auth')->group(function () {
    // BOUTEILLES
    Route::get('/bouteillesraw', [BouteilleController::class, 'indexRaw'])->name('bouteilles.listRaw');
    Route::get('/bouteilles', [BouteilleController::class, 'index'])->name('bouteilles.list');
 
    Route::post('/bouteilles_toggleFavoris/{bouteilleId}', [
        BouteilleController::class, 'toggleFavorite'
    ])->name('bouteilles.toggleFavoris');

    //achat
    Route::post('/bouteilles_togglePurchase/{bouteilleId}', [
        BouteilleController::class, 'togglePurchase'
    ])->name('bouteilles.togglePurchase');
    
    Route::get('/ajax/bouteilles', [BouteilleController::class, 'ajaxLoadMoreBouteilles'])->name('bouteilles.ajax');
    Route::get('/search/bouteilles', [BouteilleController::class, 'search'])->name('bouteilles.search');
    
    
    Route::get('/ajax/bouteilles_viewfor_managecellier/{bouteilleId}', [BouteilleController::class,
    'ajaxViewfor_managecellier'])->name('bouteilles.ajaxViewfor_managecellier');

    Route::get('/ajax/viewfor_managecellierbycellier/{cellierId}', [BouteilleCellierController::class,
    'ajaxViewfor_ManageCellierByCellier'])->name('celliers.ajaxViewfor_ManageCellierByCellier');

    Route::get('/bouteilles/{bouteille}', [BouteilleController::class, 'show'])->name('bouteilles.show');

    // CELLIERS
    Route::get('/celliers', [CellierController::class, 'index'])->name('celliers.index');
    Route::get('/cellier-create', [CellierController::class, 'create'])->name('cellier.create');
    Route::post('/cellier-create', [CellierController::class, 'store'])->name('cellier.store');
    Route::get('/celliers/{cellier}', [CellierController::class, 'show'])->name('cellier.show');
    Route::get('/cellier-edit/{cellier}', [CellierController::class, 'edit'])->name('cellier.edit');
    Route::put('/cellier-edit/{cellier}', [CellierController::class, 'update']);
    Route::delete('/celliers/{cellier}', [CellierController::class, 'destroy']);

    // BOUTEILLES DANS CELLIERS
    Route::post('/bouteilleCellier/saveAmount', [BouteilleCellierController::class,
    'saveAmount'])->name('bouteilleCellier.saveAmount');

    Route::delete('/bouteilleCellier/delete', [BouteilleCellierController::class,
    'delete'])->name('bouteilleCellier.delete');

     Route::post('/bouteilleCellier/add', [BouteilleCellierController::class,
     'add'])->name('bouteilleCellier.add');

    // Route::get('/mesfavoris', [BouteilleController::class, 'favorites'])->name('bouteilles.list');


    // PROFIL
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

<<<<<<< HEAD
   
=======
    // LISTE D'ACHAT
    Route::get('/achats', [BouteilleController::class, 'achats'])->name('bouteilles.achats');
    Route::get('/search/achats', [BouteilleController::class, 'search'])->name('achats');


    // LISTE FAVORIS
    Route::get('/favoris', [BouteilleController::class, 'favoris'])->name('bouteilles.favoris');
    Route::get('/search/favoris', [BouteilleController::class, 'search'])->name('favoris');

>>>>>>> 3b3d6b9b6655f3335c3472ebf677311baa687c21

});



require __DIR__ . '/auth.php';
