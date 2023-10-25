<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bouteille;
use App\Models\Cellier;

class BouteilleCellier extends Model
{
    use HasFactory;

    protected $table = 'bouteille_cellier';

    public function bouteille()
    {
        return $this->belongsTo(Bouteille::class, 'id_bouteille');
    }

    public function cellier()
    {
        return $this->belongsTo(Cellier::class, 'id_cellier');
    }
}

