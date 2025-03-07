<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_reservation',
        'amount',
        'currency',
        'status',
        'stripe_payment_intent_id'
    ];

    public function reservation(){
        return $this->belongsTo(Reservation::class, 'id_reservation');
    }
}
