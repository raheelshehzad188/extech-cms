<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterAdminAlertMail;
use App\Mail\NewsletterWelcomeMail;
use App\Models\NewsletterSubscriber;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class NewsletterController extends Controller
{
    public function subscribe(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'email' => 'required|email|max:190',
            'name' => 'nullable|string|max:120',
            'agree' => 'accepted',
            'source' => 'nullable|string|max:60',
        ], [
            'agree.accepted' => 'Please agree to the Privacy Policy before subscribing.',
        ]);

        $email = strtolower(trim($data['email']));
        $source = $data['source'] ?? 'footer';

        $subscriber = NewsletterSubscriber::query()->where('email', $email)->first();
        $isNew = false;
        $wasUnsubscribed = false;

        if ($subscriber) {
            $wasUnsubscribed = ! $subscriber->isSubscribed();

            if ($subscriber->isSubscribed()) {
                return $this->respond($request, 'success', 'You are already subscribed to our newsletter.');
            }

            $subscriber->forceFill([
                'name' => $data['name'] ?? $subscriber->name,
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 1000),
            ]);
            $subscriber->markSubscribed($source);
        } else {
            $isNew = true;
            $subscriber = NewsletterSubscriber::query()->create([
                'email' => $email,
                'name' => $data['name'] ?? null,
                'status' => 'subscribed',
                'source' => $source,
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 1000),
                'subscribed_at' => now(),
            ]);
        }

        $this->sendMails($subscriber, $isNew || $wasUnsubscribed);

        $message = $wasUnsubscribed
            ? 'Welcome back! Your newsletter subscription has been reactivated.'
            : 'Thank you! You have successfully subscribed to our newsletter.';

        return $this->respond($request, 'success', $message);
    }

    public function unsubscribe(string $token): View
    {
        $subscriber = NewsletterSubscriber::query()
            ->where('unsubscribe_token', $token)
            ->firstOrFail();

        if ($subscriber->isSubscribed()) {
            $subscriber->markUnsubscribed();
        }

        return view('frontend.pages.newsletter-unsubscribed', [
            'subscriber' => $subscriber,
            'seo' => (object) [
                'meta_title' => 'Unsubscribed | '.SiteSetting::current()->site_name,
                'meta_description' => 'You have been unsubscribed from our newsletter.',
            ],
        ]);
    }

    protected function sendMails(NewsletterSubscriber $subscriber, bool $notify): void
    {
        if (! $notify) {
            return;
        }

        try {
            Mail::to($subscriber->email)->send(new NewsletterWelcomeMail($subscriber));
        } catch (\Throwable $e) {
            report($e);
        }

        $adminEmail = SiteSetting::current()->email ?: config('mail.from.address');

        if ($adminEmail) {
            try {
                Mail::to($adminEmail)->send(new NewsletterAdminAlertMail($subscriber));
            } catch (\Throwable $e) {
                report($e);
            }
        }
    }

    protected function respond(Request $request, string $type, string $message): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => $type,
                'message' => $message,
            ], $type === 'success' ? 200 : 422);
        }

        return back()
            ->with($type === 'success' ? 'newsletter_success' : 'newsletter_error', $message)
            ->withFragment('newsletter');
    }
}
