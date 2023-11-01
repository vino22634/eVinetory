<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BouteilleCellier;
use App\Models\BouteilleType;



class Bouteille extends Model
{
    use HasFactory;

    protected $table = 'bouteille';

    public function type()
    {
        return $this->belongsTo(BouteilleType::class, 'type');
    }

    public function bouteilleCelliers()
    {
        return $this->hasMany(BouteilleCellier::class, 'id_bouteille');
    }


    public function userPreferences()
    {
    return $this->hasOne(BouteillePreferences::class)->where('user_id', auth()->id());
    }

}
