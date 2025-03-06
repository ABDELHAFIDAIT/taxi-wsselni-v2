<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function drivers(){
        return $this->hasMany(Driver::class, 'id_city');
    }

    public function reservationsDepart(){
        return $this->hasMany(Reservation::class, 'city_depart');
    }

    public function reservationsArrivee(){
        return $this->hasMany(Reservation::class, 'city_arrivee');
    }
}
