<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_driver',
        'permis',
        'vehicule',
        'id_city'
    ];

    public function user(){
        return $this->belongsTo(User::class,'id_driver');
    }

    public function city(){
        return $this->belongsTo(City::class, 'id_city');
    }

    public function reservations(){
        return $this->hasMany(Reservation::class, 'id_driver');
    }
}
