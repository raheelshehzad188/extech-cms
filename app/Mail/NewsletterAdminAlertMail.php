<?php

namespace App\Mail;

use App\Models\NewsletterSubscriber;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterAdminAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public NewsletterSubscriber $subscriber) {}

    public function envelope(): Envelope
    {
        $settings = SiteSetting::current();

        return new Envelope(
            from: new Address(
                config('mail.from.address', 'noreply@example.com'),
                $settings->site_name ?: config('mail.from.name', 'Extech'),
            ),
            subject: 'New newsletter subscriber: '.$this->subscriber->email,
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: view('emails.newsletter-admin-alert', [
                'subscriber' => $this->subscriber,
                'settings' => SiteSetting::current(),
            ])->render(),
        );
    }
}
