<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Driver;
use App\Models\City;


class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function showRegister(){
        $cities = City::orderBy('name', 'asc')->get();
        return view('auth.register', compact('cities'));
    }

    // Login
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            if(auth()->user()->role == 'Passenger'){
                return redirect()->intended('/');
            }else{
                return redirect()->intended('/driver/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->withInput($request->except('password'));
    }

    // Register
    public function register(Request $request){
        if($request->role == 'Passenger'){
            $validator = Validator::make($request->all(), [
                'f_name' => 'required|string|max:255',
                'l_name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'role' => 'required|string|in:Driver,Passenger',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'f_name' => 'required|string|max:255',
                'l_name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'role' => 'required|string|in:Driver,Passenger',
                'permis' => 'required|string|max:20|unique:drivers',
                'vehicule' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);
        }

        $imagePath = null;
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('users', 'public');
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $user = User::create([
            'f_name'   => $request->f_name,
            'l_name'   => $request->l_name,
            'phone'    => $request->phone,
            'photo'    => $imagePath,
            'role'     => $request->role,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($request->role == 'Driver'){
            $driver = Driver::create([
                'permis'   => $request->permis,
                'vehicule' => $request->vehicule,
                'id_driver'  => $user->id,
                'id_city'  => $request->city,
            ]);
        }

        auth()->login($user);

        if($user->role = 'Passenger'){
            return redirect()->route('homepage');
        }else{
            return redirect()->route('driver.dashboard');
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
