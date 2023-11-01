<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BouteillePreferences extends Model
{
    use HasFactory;

    protected $table = 'bouteille_preferences';

    protected $fillable = [
        'user_id',
        'bouteille_id',
        'favoris',
        'listeDachat',
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bouteille() {
        return $this->belongsTo(Bouteille::class, 'bouteille_id');
    }
}
