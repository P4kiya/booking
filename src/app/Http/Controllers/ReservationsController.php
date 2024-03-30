<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\appartement;
use App\Models\client;
use App\Models\reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ReservationsController extends Controller
{

    public function getReservations()
    {
        $reservations = reservations::all();
        $reservations = reservations::where('status', '!=', 'Expire')->get();
        return view('reservation', compact('reservations'));
    }
    public function addReservation(Request $request)
    {
        $clients = client::all();
        $appartements = appartement::all();
        $agencies = Agency::all();
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');

        return view('add-reservation', ['clients' => $clients, 'appartements' => $appartements, 'agencies' => $agencies, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'appartement_id' => 'required',
            'date_depuis' => 'required|date',
            'date_jusqua' => 'required|date',
            'prix' => 'required|numeric',
            'invite_n' => 'required|numeric',
            'total' => 'required|numeric',
            'agency_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors while creating reservation: ', $validator->errors()->toArray());
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $reservation = new reservations;
        $reservation->client_id = $request->input('client_id');
        $reservation->appartement_id = $request->input('appartement_id');
        $reservation->date_depuis = $request->input('date_depuis');
        $reservation->date_jusqua = $request->input('date_jusqua');
        $reservation->prix = $request->input('prix');
        $reservation->invite_n = $request->input('invite_n');
        $reservation->total = $request->input('total');
        $reservation->agency_id = $request->input('agency_id');
        $reservation->save();
        return redirect()->route('reservations');
    }

    public function getReservation(Request $request)
    {
        $client = $request->input('client');
        $status = $request->input('status');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $reservation = $request->input('reservation');

        $query = reservations::query();

        if ($client) {
            $query->where('client_id', $client);
        }
        if ($status) {
            $query->where('status', $status);
        }
        if ($from_date && $to_date) {
            $query->whereBetween('date_depuis', [$from_date, $to_date]);
            $query->whereBetween('date_jusqua', [$from_date, $to_date]);
        }
        if ($reservation) {
            $query->where('id', $reservation);
        }

        $reservations = $query->get();

        return view('reservation', compact('reservations'));
    }

    public function statusConfirme($id)
    {
        $reservation = reservations::find($id);
        $reservation->status = 'Valide';
        $reservation->save();
        return redirect()->route('reservations');
    }

    public function statusAnnule($id)
    {
        $reservation = reservations::find($id);
        $reservation->status = 'Annule';
        $reservation->save();
        return redirect()->route('reservations');
    }

    public function checkExpiredReservations()
    {
        $reservations = reservations::where('date_jusqua', '<', date('Y-m-d'))->get();
        foreach ($reservations as $reservation) {
            $reservation->expire = true;
            $reservation->save();
        }
    }

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->checkExpiredReservations();
            return $next($request);
        });
    }

    public function editReservation($id)
    {
        $clients = client::all();
        $appartements = appartement::all();
        $reservation = reservations::find($id);
        $agencies = Agency::all();
        return view('edit-reservation', ['reservation' => $reservation, 'clients' => $clients, 'appartements' => $appartements,'agencies' => $agencies]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required',
            'appartement_id' => 'required',
            'date_depuis' => 'required',
            'date_jusqua' => 'required',
            'prix' => 'required',
            'agency_id' => 'nullable',
            'total' => 'required|numeric',
            'invite_n' => 'required',
        ]);

        $reservation = reservations::find($id);

        if (!$reservation) {
            throw new \Exception('Reservation not found');
        }

        $reservation->client_id = $request->input('client_id');
        $reservation->appartement_id = $request->input('appartement_id');
        $reservation->date_depuis = $request->input('date_depuis');
        $reservation->date_jusqua = $request->input('date_jusqua');
        $reservation->prix = $request->input('prix');
        $reservation->total = $request->input('total');
        $reservation->agency_id = $request->input('agency_id');
        $reservation->invite_n = $request->input('invite_n');

        $reservation->save();

        return redirect()->route('reservations');
    }

    public function deleteReservation($id)
    {

        $reservation = reservations::find($id);


        $reservation->delete();

        return redirect()->route('reservations');
    }
    public function viewReservations($id){

        $reservation = reservations::find($id);

        return view('view-reservation', compact('reservation'));
    }
}
