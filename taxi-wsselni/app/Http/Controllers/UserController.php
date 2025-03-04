<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function drivers(){
        $users = User::with('driver','driver.city')->get();
        $cities = City::all();
        return view('pages.chauffeurs', compact('users', 'cities'));
    }
}