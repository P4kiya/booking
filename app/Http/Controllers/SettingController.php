<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function get()
    {
        $id = 1;
        $settings = Setting::find($id);
        return view('settings',['settings' => $settings]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'signature_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
        ]);

        $setting = new Setting;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $destinationPath = public_path('assets/img/settings/');
            $logo->move($destinationPath, $logoName);
            $setting->logo = $logoName;
        } else {
            $setting->logo = 'logo.jpg';
        }

        if ($request->hasFile('signature_image')) {
            $signatureImage = $request->file('signature_image');
            $signatureImageName = time() . '.' . $signatureImage->getClientOriginalExtension();
            $destinationPath = public_path('assets/img/settings/');
            $signatureImage->move($destinationPath, $signatureImageName);
            $setting->signature_image = $signatureImageName;
        } else {
            $setting->signature_image = 'signature.png';
        }

        $setting->name = $request->input('name');
        $setting->address = $request->input('address');
        $setting->city = $request->input('city');
        $setting->country = $request->input('country');
        $setting->save();

        return redirect()->route('settings');
    }

    public function update(Request $request)
    {
        $id = 1;
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        $setting = Setting::find($id);
        if (!$setting) {
            return response()->json(['message' => 'Setting not found'], 404);
        }

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $destinationPath = public_path('assets/img/settings/');
            $logo->move($destinationPath, $logoName);
            $setting->logo = $logoName;
        } 

        if ($request->hasFile('signature_image')) {
            $signatureImage = $request->file('signature_image');
            $signatureImageName = time() . '.' . $signatureImage->getClientOriginalExtension();
            $destinationPath = public_path('assets/img/settings/');
            $signatureImage->move($destinationPath, $signatureImageName);
            $setting->signature_image = $signatureImageName;
        }

        $setting->name = $request->input('name');
        $setting->address = $request->input('address');
        $setting->city = $request->input('city');
        $setting->country = $request->input('country');
        $setting->save();

        return redirect()->route('settings');
    }
}
