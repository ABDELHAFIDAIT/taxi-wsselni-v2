<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_depart',
        'city_arrivee',
        'id_passenger',
        'id_driver',
        'date_reservation',
    ];


    public function driver(){
        return $this->belongsTo(User::class, 'id_driver');
    }

    public function passenger(){
        return $this->belongsTo(User::class, 'id_passenger');
    }

    public function cityDepart(){
        return $this->belongsTo(City::class, 'city_depart');
    }

    public function cityArrivee(){
        return $this->belongsTo(City::class, 'city_arrivee');
    }
}
