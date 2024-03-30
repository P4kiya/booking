<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $table = 'agency';

    protected $fillable = ['name', 'color'];

    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'agency_id');
    }
}
