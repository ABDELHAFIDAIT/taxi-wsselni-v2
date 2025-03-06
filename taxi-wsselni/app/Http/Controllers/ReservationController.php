<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'city_depart' => 'required|integer',
            'city_arrivee' => 'required|integer|different:city_depart',
            'id_driver' => 'required|integer',
            'date_reservation' => 'required|date|after_or_equal:now',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        Reservation::create([
            'city_depart' => $request->city_depart,
            'city_arrivee' => $request->city_arrivee,
            'id_driver' => $request->id_driver,
            'id_passenger' => Auth::user()->id,
            'date_reservation' => $request->date_reservation,
        ]);

        return redirect()->route('chauffeurs');
    }

    public function index(){
        $reservations = Reservation::with('passenger','cityDepart','cityArrivee')->where('id_driver','=', Auth::user()->id)->orderBy('id','desc')->get();
        return view('driver.reservations', compact('reservations'));
    }

    public function accept($id){
        $reservation = Reservation::find($id);
        if($reservation->date_reservation < now()){
            return redirect()->back()->withErrors(['date_reservation' => 'Tu ne peux pas accepter cette réservation car elle est passée !']);
        }
        $reservation->status = 'accepted';
        $reservation->save();
        return redirect()->back();
    }

    public function cancel($id){
        $reservation = Reservation::find($id);
        if($reservation->date_reservation < now()->addHour()){
            return redirect()->back()->withErrors(['date_reservation' => 'Tu ne peux pas annuler cette réservation car il reste moins d\'une heure avant le départ !']);
        }
        $reservation->status = 'refused';
        $reservation->save();
        return redirect()->back();
    }

    public function trajets(){
        $trajets = Reservation::with('driver','cityDepart','cityArrivee')->where('date_reservation','<',Carbon::now())->where('status','accepted')->where('id_driver','=', Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('driver.trajets', compact('trajets'));
    }
}
