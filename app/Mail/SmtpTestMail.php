<?php

namespace App\Mail;

use App\Models\MailSetting;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SmtpTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ?string $note = null) {}

    public function envelope(): Envelope
    {
        $settings = SiteSetting::current();
        $mail = MailSetting::current();

        return new Envelope(
            from: new Address(
                $mail->from_address ?: config('mail.from.address', 'noreply@example.com'),
                $mail->from_name ?: ($settings->site_name ?: config('mail.from.name', 'Extech')),
            ),
            subject: 'SMTP Test Email — '.($settings->site_name ?: 'Extech CMS'),
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: view('emails.smtp-test', [
                'settings' => SiteSetting::current(),
                'mail' => MailSetting::current(),
                'note' => $this->note,
                'sentAt' => now()->toDateTimeString(),
            ])->render(),
        );
    }
}
