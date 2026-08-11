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

class NewsletterWelcomeMail extends Mailable
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
            subject: 'You are subscribed to '.($settings->site_name ?: 'our newsletter'),
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: view('emails.newsletter-welcome', [
                'subscriber' => $this->subscriber,
                'settings' => SiteSetting::current(),
            ])->render(),
        );
    }
}
