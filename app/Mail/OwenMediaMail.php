<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;


class OwenMediaMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $pdfPath;
    protected $name;

    /**
     * Create a new message instance.
     */
    public function __construct($pdfPath, $name)
    {
        $this->pdfPath = $pdfPath;
        $this->name = $name;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'OwenMedia Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.owenmedia',
            with: [
                'name' => $this->name, // Pass the name to the view
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
        return [
            Attachment::fromPath($this->pdfPath), // Attach the file
        ];
    }
}
