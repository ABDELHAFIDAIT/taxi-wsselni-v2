<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\City;
use App\Models\Driver;
use Illuminate\Support\Facades\Validator;

class SocialiteController extends Controller
{
    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthentication(){
        try{
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('google_id',$googleUser->id)->first();

            if(!$user){
                $userData = User::create([
                    'f_name' => $googleUser->user['given_name'],
                    'l_name' => $googleUser->user['family_name'],
                    'email' => $googleUser->email,
                    'phone' => $googleUser->phone,
                    'google_id' => $googleUser->id,
                    'photo' => $googleUser->avatar,
                    'password' => Hash::make('Hafid2002@'),
                ]);

                if($userData){
                    return redirect()->route('auth.confirm',['user'=>$userData]);
                }
            }else{
                auth()->login($user);
                if($user->role == 'Passenger'){
                    return redirect()->route('homepage');
                }else{
                    return redirect()->route('driver.dashboard');
                }
            }
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    public function showConfirm(){
        $cities = City::orderBy('name','asc')->get();
        return view('auth.confirm',compact('cities'));
    }

    public function confirm(Request $request){
        if($request->role == 'Driver'){
            $validator = Validator::make($request->all(), [
                'permis' => 'required|string|max:20',
                'vehicule' => 'required|string|max:255',
                'city' => 'required|integer|exists:cities,id',
                'id' => 'required|integer|exists:users,id',
                'phone' => 'required|string|max:15',
                'role' => 'required|string|in:Driver,Passenger',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer|exists:users,id',
                'phone' => 'required|string|max:15',
                'role' => 'required|string|in:Driver,Passenger',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($request->id);
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->save();



        if($request->role == 'Driver'){
            $driver = Driver::create([
                'permis'   => $request->permis,
                'vehicule' => $request->vehicule,
                'id_driver'  => $user->id,
                'id_city'  => $request->city,
            ]);
        }

        auth()->login($user);

        if($request->role == 'Passenger'){
            return redirect()->route('homepage');
        }else{
            return redirect()->route('driver.dashboard');
        }
    }
}
