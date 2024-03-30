<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class appartement extends Model
{
    use HasFactory;

    protected $table = 'appartements';

    

    protected $fillable = [
        'img',
        'prix_haut',
        'prix_bas',
        'numero_appartement',
        'etage',
        'nombre_chambre',
        'capacite_appartement',
        'status'
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(reservations::class, 'appartement_id');
    }
}
