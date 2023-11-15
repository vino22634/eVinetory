<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BouteilleCellier;
use App\Models\BouteilleType;
use App\Models\BouteillePreferences;
use App\Models\PastilleType;
use App\Models\Cellier;

class Bouteille extends Model
{
    use HasFactory;

    protected $table = 'bouteille';

    /**
     * Renvoit le type de vin de la bouteille
     * type = 1 : vin rouge
     * type = 2 : vin blanc
     */
    public function type()
    {
        return $this->belongsTo(BouteilleType::class, 'type');
    }

    /**
     * Renvoit le statut favoris et liste d'achat de la bouteille
     */    
    public function userPreferences()
    {
        return $this->hasOne(BouteillePreferences::class)->where('user_id', auth()->id());
    }

    /**
     * Renvoit la pastille de la bouteille
     */
    public function pastilleType()
    {
        return $this->belongsTo(PastilleType::class, 'pastille_id');
    }


    public function bouteilleCelliers()
    {
        return $this->hasMany(BouteilleCellier::class, 'id_bouteille');
    }
    
    
    public function bouteilleCelliersForUser()
    {
        $userId = auth()->id();
        return $this->bouteilleCelliers()->whereHas('cellier', function ($query) use ($userId) {
        $query->where('user_id', $userId);
        })->get();
    }

    
    /**
     * Renvoit les celliers de l'utilisateur avec la quantité de bouteilles de la bouteille
     * Renvoit null si la bouteille n'est pas dans un cellier
     */
    public function bouteilleDansCelliersUser()
    {
        $bouteilleId = $this->id;
        $userId = auth()->id();

        return Cellier::select('celliers.id', 'celliers.name', 'bouteille_cellier.quantite', 'bouteille_cellier.id_bouteille')
            ->leftJoin('bouteille_cellier', function ($join) use ($bouteilleId) {
                $join->on('celliers.id', '=', 'bouteille_cellier.id_cellier')
                    ->where('bouteille_cellier.id_bouteille', '=', $bouteilleId);
            })
            ->where('celliers.user_id', '=', $userId)
            ->orderBy('celliers.name')
            ->get();
    }
}
