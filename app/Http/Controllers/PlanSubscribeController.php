<?php

namespace App\Http\Controllers;

use App\Mail\PlanSubscribeCustomerMail;
use App\Mail\PlanSubscribeMail;
use App\Models\Page;
use App\Models\PlanSubscription;
use App\Models\PricingPlan;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanSubscribeController extends Controller
{
    public function show(PricingPlan $plan): View
    {
        if (! $plan->is_published) {
            abort(404);
        }

        return view('frontend.pages.plan-subscribe', [
            'plan' => $plan,
            'seo' => $this->pageSeo('plan-subscribe', 'Get Started — '.$plan->name),
        ]);
    }

    public function store(Request $request, PricingPlan $plan)
    {
        if (! $plan->is_published) {
            abort(404);
        }

        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:190',
            'phone' => 'required|string|max:40',
            'whatsapp' => 'required|string|max:40',
            'business_name' => 'required|string|max:160',
            'website' => 'nullable|string|max:255',
            'country' => 'required|string|max:120',
            'address' => 'required|string|max:2000',
            'message' => 'nullable|string|max:5000',
        ]);

        $planPrice = trim($plan->displayPrice().' '.$plan->displaySuffix());

        $subscription = PlanSubscription::query()->create([
            'pricing_plan_id' => $plan->id,
            'plan_name' => $plan->name,
            'plan_price' => $planPrice,
            'payment_type' => 'one_time',
            'name' => $data['name'],
            'email' => strtolower(trim($data['email'])),
            'phone' => $data['phone'],
            'whatsapp' => $data['whatsapp'],
            'company' => $data['business_name'],
            'business_name' => $data['business_name'],
            'website' => $data['website'] ?? null,
            'country' => $data['country'],
            'address' => $data['address'],
            'message' => $data['message'] ?? null,
            'status' => 'pending',
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 1000),
        ]);

        $settings = SiteSetting::current();
        $adminEmail = $settings->email ?: config('mail.from.address');

        try {
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new PlanSubscribeMail($subscription));
            }
            Mail::to($subscription->email)->send(new PlanSubscribeCustomerMail($subscription));
        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('plan.subscribe', $plan)
                ->with('success', 'Your request was saved. We will contact you soon.')
                ->with('warning', 'Email notification could not be sent. Please check mail settings.');
        }

        return redirect()
            ->route('plan.subscribe', $plan)
            ->with('success', 'Thank you! Your request for "'.$plan->name.'" ('.$planPrice.') has been submitted. We will contact you shortly.');
    }

    protected function pageSeo(string $slug, string $fallbackTitle)
    {
        return Page::query()->where('slug', $slug)->where('is_published', true)->first()
            ?? tap(new Page([
                'title' => $fallbackTitle,
                'meta_title' => $fallbackTitle.' | '.SiteSetting::current()->site_name,
                'meta_description' => $fallbackTitle,
            ]), fn () => null);
    }
}
