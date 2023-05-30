<?php

namespace App\Mail;

use App\Models\Bouquet;
use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    private Purchase $purchase;

    /**
     * Create a new message instance.
     */
    public function __construct(Purchase $purchase)
    {
        $this -> $purchase = $purchase;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        $bouquetName = Bouquet::find($this->purchase->chosen_bouquet);
        $bouquetPrice = Bouquet::find($this->purchase->chosen_bouquet);

        return new Content(
            view: 'confirmation-mail',
            with: [
                "booking" => $this -> purchase,
                "bouquetName" => $bouquetName,
                "bouquetPrice" => $bouquetPrice
            ]
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
