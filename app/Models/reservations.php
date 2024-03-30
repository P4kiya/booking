<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservations extends Model
{
    use HasFactory;

    protected $table = 'reservations';


    protected $fillable = [
        'client_id',
        'appartement_id',
        'agency_id',
        'date_depuis',
        'date_jusqua',
        'prix',
        'invite_n',
        'total',
        'status',
        'expire'
    ];

    public function client()
    {
        return $this->belongsTo(client::class, 'client_id');
    }

    public function appartement()
    {
        return $this->belongsTo(appartement::class, 'appartement_id');
    }

    public function agency()
    {
        return $this->belongsTo(agency::class, 'agency_id');
    }
}

