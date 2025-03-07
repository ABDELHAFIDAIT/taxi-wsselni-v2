<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function index()
    {
        $reactions = Reaction::with('Passenger')
                            ->where('id_driver',Auth::user()->id)
                            ->orderBy('created_at','desc')
                            ->get();
    
        return view('driver.reactions', compact( 'reactions'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'id_driver' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Reaction::create([
            'id_driver' => $request->input('id_driver'),
            'id_passenger' => Auth::user()->id,
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Votre avis a été ajouté avec succès.');
    }



}
