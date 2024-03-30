<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\appartement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AppartementController extends Controller
{
    public function getAppartements()
    {
        $appartements = appartement::paginate(6);
        return view('appartements', compact('appartements'));
    }
    public function addAppartement()
    {
        return view('add-appartement');
    }

    public function status(Request $request, $id)
    {
        $appartement = appartement::find($id);
        if ($appartement->status == 'active') {
            $appartement->status = 'inactive';
        } else {
            $appartement->status = 'active';
        }
        $appartement->save();
        return redirect()->route('appartements');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img' => 'sometimes|image',
            'prix_haut' => 'required',
            'prix_bas' => 'required',
            'numero_appartement' => 'required',
            'etage' => 'required',
            'nombre_chambre' => 'required',
            'capacite_appartement' => 'required',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors while creating appartement: ', $validator->errors()->toArray());
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $appartement = new appartement();
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/img/appartements/');
            $image->move($destinationPath, $name);
            $appartement->img = $name;
        } else {
            $appartement->img = '';
        }
        $appartement->prix_haut = $request->input('prix_haut');
        $appartement->prix_bas = $request->input('prix_bas');
        $appartement->numero_appartement = $request->input('numero_appartement');
        $appartement->etage = $request->input('etage');
        $appartement->nombre_chambre = $request->input('nombre_chambre');
        $appartement->capacite_appartement = $request->input('capacite_appartement');
        $appartement->status = 'active';
        $appartement->save();
        return redirect()->route('appartements');
    }
    public function deleteAppartement($id)
    {
        $appartement = appartement::find($id);

        $appartement->delete();

        return redirect()->route('appartements');
    }
    public function getappartement($id)
    {
        try {
            $appartement = appartement::find($id);

            if (!$appartement) {
                return response()->json([
                    'status' => 404,
                    'message' => 'appartement not found',
                ]);
            }

            return response()->json([
                'status' => 200,
                'appartement' => $appartement,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
    public function editappartement($id)
    {
        $appartement = appartement::find($id);
        return view('edit-appartement', ['appartement' => $appartement]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'img' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
            'prix_haut' => 'required',
            'prix_bas' => 'required',
            'numero_appartement' => 'required',
            'etage' => 'required',
            'nombre_chambre' => 'required',
            'capacite_appartement' => 'required',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors while updating appartement: ', $validator->errors()->toArray());
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $appartement = Appartement::find($id);

        if (!$appartement) {
            return response()->json([
                'status' => 404,
                'error' => 'Appartement not found',
            ]);
        }

        if ($request->hasFile('img')) {
            // Delete old image
            $oldImagePath = public_path('assets/img/appartements/') . $appartement->img;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Process and save new image
            $image = $request->file('img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/img/appartements/');
            $image->move($destinationPath, $name);
            $appartement->img = $name;
        }

        $appartement->prix_haut = $request->input('prix_haut');
        $appartement->prix_bas = $request->input('prix_bas');
        $appartement->numero_appartement = $request->input('numero_appartement');
        $appartement->etage = $request->input('etage');
        $appartement->nombre_chambre = $request->input('nombre_chambre');
        $appartement->capacite_appartement = $request->input('capacite_appartement');

        $appartement->save();

        return redirect()->route('appartements');
    }
}
