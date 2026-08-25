<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Put the customer and the tour in the subject line so the team can
        // triage straight from the inbox list without opening the mail.
        $name    = trim((string) ($this->details['name'] ?? ''));
        $package = trim((string) ($this->details['package'] ?? ''));

        $subject = 'New Booking Inquiry';
        if ($name !== '') {
            $subject .= ' — ' . $name;
        }
        if ($package !== '') {
            $subject .= ' (' . $package . ')';
        }

        // Reply-To the customer: hitting "Reply" in the inbox answers the
        // traveller directly instead of the info@ mailbox that sent it.
        $replyTo = [];
        $customerEmail = trim((string) ($this->details['email'] ?? ''));
        if ($customerEmail !== '' && filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
            $replyTo[] = new Address($customerEmail, $name !== '' ? $name : $customerEmail);
        }

        return new Envelope(
            subject: $subject,
            replyTo: $replyTo,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_inquiry',
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
