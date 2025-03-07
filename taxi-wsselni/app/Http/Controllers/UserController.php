<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function drivers(){
        $users = User::with('driver','driver.city')->get();
        $cities = City::all();
        return view('pages.chauffeurs', compact('users', 'cities'));
    }


    public function editPassenger(Request $request){
        $passenger = User::findOrFail(Auth::user()->id);
        $passenger->f_name = $request->f_name;
        $passenger->l_name = $request->l_name;
        $passenger->email = $request->email;
        $passenger->phone = $request->phone;
        $passenger->save();
        return redirect()->back()->with('success', 'Profile est mis à jour avec succès');
    }
}