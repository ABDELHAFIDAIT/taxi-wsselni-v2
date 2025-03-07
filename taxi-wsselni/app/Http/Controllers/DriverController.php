<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    public function index(){
        $drivers = User::with('driver','driver.city')->withCount('reservationsDriver')->where('role','Driver')->get();
        return view('admin.drivers', compact('drivers'));
    }




    public function show(){
        $driver = Driver::with(['city', 'user'])->where('id_driver', Auth::id())->first();
        $cities = City::orderBy('name', 'asc')->get();
        return view('driver.profile', compact('driver', 'cities'));
    }

    public function edit(Request $request){
        $validator = Validator::make($request->all(), [
            'permis' => 'nullable|string|min:6|max:20|unique:drivers',
            'vehicule' => 'nullable|string|max:255',
        ]);

        

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $driver = Driver::where('id_driver',Auth::user()->id)->first();

        // if($request->has('permis')){
        //     $driver->permis = $request->permis;
        // }

        // if($request->has('vehicule')){
        //     $driver->vehicule = $request->vehicule;
        // }

        // if($request->has('city')){
        //     $driver->id_city = $request->city;
        // }

        // $driver->save();
        
        $driver->update([
            'permis' => $request->permis,
            'vehicule' => $request->vehicule,
            'id_city' => $request->city,
        ]);
        return redirect()->back()->with('success', 'Profile est mis à jour avec succès');
    }

    public function search(Request $request){
        $query = $request->input('query');
        $city = $request->input('city');

        $drivers = Driver::with('city', 'user')
            ->whereHas('user', function ($q) use ($query) {
                if ($query) {
                    $q->where('l_name', 'LIKE', "%{$query}%")
                    ->orWhere('f_name', 'LIKE', "%{$query}%");
                }
            })
            ->when($city, function ($q) use ($city) {
                return $q->where('id_city', $city);
            })
            ->get();

        $cities = City::orderBy('name', 'asc')->get();

        return view('pages.search', compact('drivers', 'cities'));
    }

}
