<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibility extends Model
{
    use HasFactory;

    protected $table = 'disponibility';


    protected $fillable = [
        'debut_disponibility',
        'fin_disponibility',
    ];

    public function driverDisponibility()
    {
        return $this->hasMany(DriverDisponibility::class, 'id_disponibility');
    }
}
