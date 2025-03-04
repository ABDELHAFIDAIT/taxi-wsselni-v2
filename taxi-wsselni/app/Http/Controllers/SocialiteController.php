<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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
                    'role' => 'Passenger',
                ]);

                if($userData){
                    auth()->login($userData);
                    return redirect()->route('homepage');
                }
            }else{
                auth()->login($user);
                return redirect()->route('homepage');
            }
        }catch(\Exception $e){
            dd($e->getMessage());
        }
        
        // dd($googleUser);
    }
}
