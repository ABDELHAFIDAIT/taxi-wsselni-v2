<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Exception\CardException;
use App\Models\Payment;
use App\Models\Reservation;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // die('hh');
        Stripe::setApiKey(config('services.stripe.secret'));
        // die('hhhh');
        try {
            // die('hhhhhh');
            $charge = Charge::create([
                'amount' => $request->input('amount') * 100,
                'currency' => 'MAD',
                'source' => $request->input('stripeToken'),
                'description' => 'Trip Booking Payment',
            ]);
    
            $reservation = Reservation::findOrFail($request->input('id_reservation'));
            

            $payment = Payment::create([
                'id_reservation' => $reservation->id,
                'amount' => $request->input('amount'),
                'currency' => 'MAD',
                'stripe_payment_intent_id' => $charge->id,
                'status' => 'passed',
            ]);
            
            if ($payment) {
                $reservation->update(['isPayed' => true]);
            }

            return redirect()->route('passenger.reservations')->with('success', 'Payment Effectué avec Succés! Ta Réservation est confirmé.');

        } catch (CardException $e) {

            $errorMessage = $this->getCardErrorMessage($e->getDeclineCode() ?? $e->getCode());
            return back()->withErrors($errorMessage);

        } catch (\Exception $e) {

            // dd($e);
            return back()->withErrors('Une erreur inattendue s\'est produite. Veuillez réessayer.');
        }
    }

    private function getCardErrorMessage($declineCode)
    {
        switch ($declineCode) {
            case 'stolen_card':
                return 'Votre carte a été refusée car elle a été signalée comme volée. Veuillez utiliser une autre carte.';
            case 'insufficient_funds':
                return 'Votre carte a été refusée en raison de fonds insuffisants. Veuillez utiliser une autre carte ou ajouter des fonds sur votre compte.';
            case 'expired_card':
                return 'Votre carte a été refusée car elle est expirée. Veuillez utiliser une autre carte.';
            case 'card_declined':
                return 'Votre carte a été refusée. Veuillez vérifier les informations de votre carte ou utiliser une autre carte.';
            default:
                return 'Votre carte a été refusée. Veuillez réessayer ou utiliser une autre carte.';
        }
    }
}
