<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class client extends Model
{
    use HasFactory;

    protected $table = 'clients';



    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'phone',
        'gendre',
        'cnie',
        'pays',
        'ville',
        'region',
        'code_postal'
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(reservations::class);
    }
}
