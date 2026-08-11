@php
    $pricingPlans = $pricingPlans ?? collect();
    $pricingSubtitle = $home['pricing_subtitle'] ?? 'Our Pricing';
    $pricingTitle = $home['pricing_title'] ?? 'Our Awesome Pricing Plans';
@endphp

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
            </div>

            <div class="row gy-5">
                @foreach($pricingPlans as $plan)
                    @include('frontend.partials.pricing-card', [
                        'plan' => $plan,
                        'price' => $plan->displayPrice(),
                        'suffix' => $plan->displaySuffix(),
                    ])
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
