<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BouteilleCellier;
use App\Models\Bouteille;

class Cellier extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bouteillesCellier()
    {
        return $this->hasMany(BouteilleCellier::class, 'id_cellier');
    }

    public function detailsBouteillesCellier()
    {
        return $this->belongsToMany(Bouteille::class, 'bouteille_cellier', 'id_cellier', 'id_bouteille')->withPivot('quantite');
    }
}
