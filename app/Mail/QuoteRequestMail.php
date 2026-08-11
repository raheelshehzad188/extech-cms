<?php

namespace App\Mail;

use App\Models\PricingPlan;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name: string, email: string, phone?: string|null, message: string, service_id?: int|null, plan_id?: int|null}  $data
     */
    public function __construct(
        public array $data,
        public ?Service $service = null,
        public ?PricingPlan $plan = null,
    ) {}

    public function envelope(): Envelope
    {
        $settings = SiteSetting::current();
        $serviceTitle = $this->service?->title;
        $subject = $serviceTitle
            ? 'Quote Request: '.$serviceTitle
            : 'New Get A Quote Request';

        return new Envelope(
            from: new Address(
                config('mail.from.address', 'noreply@example.com'),
                $settings->site_name ?: config('mail.from.name', 'Extech'),
            ),
            replyTo: [
                new Address($this->data['email'], $this->data['name']),
            ],
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: view('emails.quote-request', [
                'data' => $this->data,
                'service' => $this->service,
                'plan' => $this->plan,
                'settings' => SiteSetting::current(),
            ])->render(),
        );
    }
}
