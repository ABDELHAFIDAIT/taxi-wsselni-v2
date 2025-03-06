<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverDisponibility extends Model
{
    use HasFactory;

    protected $table = 'driver_disponibility';
    protected $fillable = [
        'id_driver',
        'id_disponibility',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'id_driver');
    }

    public function disponibility()
    {
        return $this->belongsTo(Disponibility::class, 'id_disponibility');
    }
}
