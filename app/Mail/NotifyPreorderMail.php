<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyPreorderMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('app.name')),
            to: $this->data['email'],
            cc: $this->data['email'],
            bcc: $this->data['email'],
            replyTo: config('mail.from.address'),
            subject: trans('mail.invoice_preorder.subject'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */

    public function content(): Content
    {
        return new Content(
            view: 'emails.NotifyPreorderMail',
        );
    }
}
