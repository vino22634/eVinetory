<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BouteilleType;
use App\Models\BouteillePreferences;
use App\Models\PastilleType;

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

    
    public function bouteilleCelliersForUser($userId)
    {
        return $this->bouteilleCelliers()->whereHas('cellier', function ($query) use ($userId) {
        $query->where('user_id', $userId);
        })->get();
    }
}
