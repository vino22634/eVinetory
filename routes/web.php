<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CellierController;

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
    Route::post('/bouteilles_togglePurchase/{bouteilleId}', [
        BouteilleController::class, 'togglePurchase'
    ])->name('bouteilles.togglePurchase');
    Route::get('/ajax/bouteilles', [BouteilleController::class, 'ajaxLoadMoreBouteilles'])->name('bouteilles.ajax');

    // CELLIERS
    Route::get('/celliers', [CellierController::class, 'index'])->name('celliers.index');
    Route::get('/cellier-create', [CellierController::class, 'create'])->name('cellier.create');
    Route::post('/cellier-create', [CellierController::class, 'store'])->name('cellier.store');
    Route::get('/cellier-show/{cellier}', [CellierController::class, 'show'])->name('cellier.show');
    Route::get('/cellier-edit/{cellier}', [CellierController::class, 'edit'])->name('cellier.edit');
    Route::put('/cellier-edit/{cellier}', [CellierController::class, 'update']);

    // PROFIL
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
