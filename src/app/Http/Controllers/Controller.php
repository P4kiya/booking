<?php

namespace App\Http\Controllers;

use App\Models\appartement;
use App\Models\client;
use App\Models\reservations;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showDashboard()
{
    $clients = client::all();
    $appartements = appartement::all();
    $reservations = reservations::all();
    return view('/dashboard', ['clients' => $clients, 'appartements' => $appartements,'reservations' => $reservations]);
}
}
