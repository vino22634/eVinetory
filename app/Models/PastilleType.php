<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastilleType extends Model
{
    protected $table = 'pastille_type';
    protected $primaryKey = 'id';

    // Let Eloquent know that these columns can be filled with mass assignments
    protected $fillable = [
        'description',
        'couleur',
        'tag_saq',
        'imageURL_custom',
        'imageURL'
    ];

    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    // récupérer les bouteilles qui ont cette pastille
    public function bouteilles()
    {
        return $this->hasMany(Bouteille::class, 'pastille_id');
    }
}
