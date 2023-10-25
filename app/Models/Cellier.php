<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BouteilleCellier;

class Cellier extends Model
{
    use HasFactory;

    protected $table = 'cellier';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bouteilleCelliers()
    {
        return $this->hasMany(BouteilleCellier::class, 'id_cellier');
    }
}





