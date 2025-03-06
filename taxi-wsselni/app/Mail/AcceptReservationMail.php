<?php

namespace App\Mail;

use Endroid\QrCode\QrCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class AcceptReservationMail extends Mailable
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

    public function build()
    {
        $qrData = "Passenger : {$this->passenger}\n
                Date de Réservation : {$this->date}\n
                Ville de Départ : {$this->depart}\n
                Ville de Destination : {$this->destination}\n
                Chauffeur : {$this->driver}\n
                Véhicule : {$this->car}";

        $qrCode = new QrCode($qrData);

        $writer = new PngWriter();

        $qrFilePath = storage_path('app/public/qrcodes/user_' . $this->passenger . '_qr.png');

        $directory = storage_path('app/public/qrcodes');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $qrImageData = $writer->write($qrCode);
        file_put_contents($qrFilePath, $qrImageData->getString());

        return $this->subject('Confirmation de Votre Réservation sur TAXI WSSELNI - QR Code')
                    ->view('mails.accept') 
                    ->attach($qrFilePath, [
                    'as' => 'reservation_info_qr.png',
                    'mime' => 'image/png',
        ]);
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Confirmation de Votre Réservation sur TAXI WSSELNI',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'mails.accept',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
