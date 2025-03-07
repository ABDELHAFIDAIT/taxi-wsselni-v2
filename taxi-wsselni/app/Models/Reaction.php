<?php

namespace App\Models;

use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'id_driver',
        'id_passenger',
    ];

    public function Driver(){
        return $this->belongsTo(User::class,'id_driver');
    }

    public function Passenger(){
        return $this->belongsTo(User::class,'id_passenger');
    }
}
