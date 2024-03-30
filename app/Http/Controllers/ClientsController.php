<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ClientsController extends Controller
{
    public function getClients()
    {
        $clients = client::all();
        return view('clients', compact('clients'));
    }

    public function addClient()
    {
        return view('add-client');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required',
            'gendre' => 'required',
            'cnie' => 'required|unique:clients,cnie',
            'pays' => 'required',
            'ville' => 'required',
            'region' => 'required',
            'code_postal' => 'required',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors while creating client: ', $validator->errors()->toArray());
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $client = new client;
        $client->nom = $request->input('nom');
        $client->prenom = $request->input('prenom');
        $client->email = $request->input('email');
        $client->phone = $request->input('phone');
        $client->gendre = $request->input('gendre');
        $client->cnie = $request->input('cnie');
        $client->pays = $request->input('pays');
        $client->ville = $request->input('ville');
        $client->region = $request->input('region');
        $client->code_postal = $request->input('code_postal');
        $client->save();
        return redirect()->route('clients');    
    }

    public function getClient($id)
    {
        $client = client::find($id);
        return view('/profile', ['client' => $client]);
    }
    public function editClient($id)
    {
        $client = Client::find($id);
        return view('edit-client', ['client' => $client]);
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'gendre' => 'required',
                'cnie' => 'required',
                'pays' => 'required',
                'ville' => 'required',
                'region' => 'required',
                'code_postal' => 'required',
            ]);

            $client = client::find($id);

            if (!$client) {
                throw new \Exception('Client not found');
            }

            $client->nom = $request->input('nom');
            $client->prenom = $request->input('prenom');
            $client->email = $request->input('email');
            $client->phone = $request->input('phone');
            $client->gendre = $request->input('gendre');
            $client->cnie = $request->input('cnie');
            $client->pays = $request->input('pays');
            $client->ville = $request->input('ville');
            $client->region = $request->input('region');
            $client->code_postal = $request->input('code_postal');

            $client->save();

            return redirect()->route('clients');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function deleteClient($id)
    {

        $client = client::find($id);


        $client->delete();

        return redirect()->route('clients');
    }
}
