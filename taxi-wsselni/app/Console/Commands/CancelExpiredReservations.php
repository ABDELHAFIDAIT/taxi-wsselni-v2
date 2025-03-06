<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class CancelExpiredReservations extends Command
{
    protected $signature = 'reservations:cancel-expired';
    protected $description = 'Annule automatiquement les réservations passées';

    public function handle()
    {
        $reservations = Reservation::where('date_reservation', '<', Carbon::now())
            ->where('status', '=', 'pending')
            ->update(['status' => 'refused']);

        $this->info("$reservations réservation(s) annulée(s) automatiquement.");
    }
}
