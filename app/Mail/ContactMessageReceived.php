<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactMessage $contactMessage)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesan Konsultasi Baru: ' . ($this->contactMessage->subject ?: $this->contactMessage->name),
            replyTo: [$this->contactMessage->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.contact-message-received',
            with: ['contact' => $this->contactMessage],
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
