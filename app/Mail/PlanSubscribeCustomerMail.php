<?php

namespace App\Mail;

use App\Models\PlanSubscription;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PlanSubscribeCustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public PlanSubscription $subscription) {}

    public function envelope(): Envelope
    {
        $settings = SiteSetting::current();

        return new Envelope(
            from: new Address(
                config('mail.from.address', 'noreply@example.com'),
                $settings->site_name ?: config('mail.from.name', 'Extech'),
            ),
            subject: 'We received your '.$this->subscription->plan_name.' package request',
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: view('emails.plan-subscribe-customer', [
                'subscription' => $this->subscription,
                'settings' => SiteSetting::current(),
            ])->render(),
        );
    }
}
