<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RefuseReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $passenger;
    public $date;
    public $depart;
    public $destination;
    public $driver;
    public $car;

    /**
     * Create a new message instance.
     */
    
    public function __construct($passenger, $date, $depart, $destination, $driver, $car)
    {
        $this->passenger = $passenger;
        $this->date = $date;
        $this->depart = $depart;
        $this->destination = $destination;
        $this->driver = $driver;
        $this->car = $car;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Status de Votre Réservation sur TAXI WSSELNI',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.refuse',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
