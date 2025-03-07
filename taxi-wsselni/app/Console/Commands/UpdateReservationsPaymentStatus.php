<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;

class UpdateReservationsPaymentStatus extends Command
{
    protected $signature = 'reservations:update-payment';
    protected $description = 'Met à jour isPayed des réservations payées';

    public function handle()
    {
        $reservations = Reservation::whereIn('id', function ($query) {
            $query->select('id_reservation')
                  ->from('payments')
                  ->where('status', 'passed');
        })->where('isPayed', false)
          ->update(['isPayed' => true]);

        // Log::info("Mise à jour des réservations : {$reservations} réservations mises à jour.");
        
        $this->info("Mise à jour terminée. {$reservations} réservations mises à jour.");
    }
}
