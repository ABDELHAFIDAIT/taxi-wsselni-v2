<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Disponibility;
use App\Models\DriverDisponibility;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DisponibilityController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'debut_disponibility' => 'required',
            'fin_disponibility' => 'required|after:debut_disponibility',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        $disponibility = Disponibility::create([
            'debut_disponibility' => $request->debut_disponibility,
            'fin_disponibility' => $request->fin_disponibility,
        ]);

        $driverDisponibility = DriverDisponibility::create([
            'id_driver' => Auth::user()->id,
            'id_disponibility' => $disponibility->id,
        ]);

        return redirect()->route('driver.disponibility');

    }

    public function show(){
        // $disponibilities = Disponibility::with('driverDisponibility')->where('driverDisponibility.id_driver',Auth::user()->id)->get();
        $disponibilities = Disponibility::whereHas('driverDisponibility', function ($query) {
            $query->where('id_driver', Auth::user()->id);
        })->with('driverDisponibility')->get();
        return view('driver.disponibility', compact('disponibilities'));
    }

    public function getDisponibilities(){
        $disponibilities = Disponibility::whereHas('driverDisponibility', function ($query)  {
            $query->where('id_driver', Auth::user()->id);
        })->get();

        $events = $disponibilities->map(function ($dispo) {
            return [
                'title' => 'Disponible',
                'start' => $dispo->debut_disponibility,
                'end' => $dispo->fin_disponibility,
                'backgroundColor' => 'green',
                'borderColor' => 'green',
            ];
        });

        return response()->json($events);
    }

    public function index(){
        return view('driver.disponibility');
    }

}
