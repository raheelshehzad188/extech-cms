@php
    $pricingPlans = $pricingPlans ?? collect();
    $pricingSubtitle = $home['pricing_subtitle'] ?? 'Our Pricing';
    $pricingTitle = $home['pricing_title'] ?? 'Our Awesome Pricing Plans';
    $pricingSaveText = $home['pricing_save_text'] ?? 'Save 25%';
    $monthlyLabel = $home['pricing_monthly_label'] ?? 'Monthly';
    $yearlyLabel = $home['pricing_yearly_label'] ?? 'Yearly';
@endphp

@if(auth()->check() || config('app.debug'))
    <div class="container" style="margin-top:20px;margin-bottom:10px;">
        <form method="POST" action="{{ route('pricing.fill-defaults') }}" onsubmit="return confirm('Pricing plans default data set kar dein? Existing plans replace ho jayenge.');">
            @csrf
            <button type="submit" class="theme-btn" style="background:#f59e0b;border:0;">
                Fill Default Pricing Data
                <i class="fa-solid fa-wand-magic-sparkles"></i>
            </button>
            <small style="display:block;margin-top:8px;opacity:.75;">
                Press se 3 default plans + pricing section titles set. Manual DB edit ki zarurat nahi.
            </small>
        </form>
    </div>
@endif

@if($pricingPlans->isNotEmpty())
<section class="pricing-section fix section-padding" id="pricing">
    <div class="pricing-wrapper style1">
        <div class="shape1 d-none d-xxl-block">
            <img src="{{ asset('assets/img/shape/pricingShape1_1.png') }}" alt="shape">
        </div>
        <div class="shape2 d-none d-xxl-block">
            <img src="{{ asset('assets/img/shape/pricingShape1_2.png') }}" alt="shape">
        </div>
        <div class="container">
            <div class="section-title title-area mx-auto mb-25">
                <div class="subtitle d-flex justify-content-center">
                    <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                    <span>{{ $pricingSubtitle }}</span>
                    <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                </div>
                <h2 class="title text-center">{{ $pricingTitle }}</h2>

                <div class="tab-section d-flex justify-content-center align-items-center">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-monthly-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-monthly" type="button" role="tab"
                                aria-controls="pills-monthly" aria-selected="true">{{ $monthlyLabel }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-yearly-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-yearly" type="button" role="tab"
                                aria-controls="pills-yearly" aria-selected="false">{{ $yearlyLabel }}</button>
                        </li>
                    </ul>
                    <img src="{{ asset('assets/img/icon/pricingIcon1_2.svg') }}" alt="icon">
                    <span class="save">{{ $pricingSaveText }}</span>
                </div>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="pills-monthly" role="tabpanel" aria-labelledby="pills-monthly-tab">
                    <div class="row gy-5">
                        @foreach($pricingPlans as $plan)
                            @include('frontend.partials.pricing-card', [
                                'plan' => $plan,
                                'price' => $plan->monthly_price,
                                'suffix' => $plan->monthly_suffix ?: '/ Month',
                            ])
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-yearly" role="tabpanel" aria-labelledby="pills-yearly-tab">
                    <div class="row gy-5">
                        @foreach($pricingPlans as $plan)
                            @include('frontend.partials.pricing-card', [
                                'plan' => $plan,
                                'price' => $plan->yearly_price ?: $plan->monthly_price,
                                'suffix' => $plan->yearly_suffix ?: '/ Year',
                            ])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
