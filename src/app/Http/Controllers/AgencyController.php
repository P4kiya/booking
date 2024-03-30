<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\appartement;
use App\Models\reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AgencyController extends Controller
{


    public function addAgency(Request $request)
    {
        $days = ['lundi' => 'monday', 'mardi' => 'tuesday', 'mercredi' => 'wednesday', 'jeudi' => 'thursday', 'vendredi' => 'friday', 'samedi' => 'saturday', 'dimanche' => 'sunday'];
        $dates = [];
        $week = $request->query('weekOffset', 0);
        if (strpos($week, '-') !== false) {
            $week = str_replace('-', '', $week);
            foreach ($days as $frenchDay => $englishDay) {
                $dates[$frenchDay] = \Carbon\Carbon::now()->startOfWeek()->addDay(array_search($englishDay, array_values($days)) - $week * 7)->format('Y-m-d');
            }
        } else {
            foreach ($days as $frenchDay => $englishDay) {
                $dates[$frenchDay] = \Carbon\Carbon::now()->startOfWeek()->addDay(array_search($englishDay, array_values($days)) + $week * 7)->format('Y-m-d');
            }
        }
        $agencies = Agency::all();
        $appartements = appartement::all();
        $reservations = reservations::all();

        return view('calendar', ['agencies' => $agencies, 'appartements' => $appartements, 'reservations' => $reservations, 'dates' => $dates]);
    }

    public function storeAgency(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'color' => 'required',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors while creating Agency: ', $validator->errors()->toArray());
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $client = new Agency;
        $client->name = $request->input('name'); // Changed 'nom' to 'name'
        $client->color = $request->input('color');
        $client->timestamps = false; // Disable timestamps
        $client->save(['timestamps' => false]); // Disable timestamps while saving
        return redirect()->route('addAgency');
    }
}
