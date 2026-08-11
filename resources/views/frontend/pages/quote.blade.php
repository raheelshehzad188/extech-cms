@extends('layouts.frontend')

@section('content')
@include('frontend.partials.breadcrumb', [
    'title' => 'Get A Quote',
    'subtitle' => $selectedService?->title ? 'Quote for '.$selectedService->title : 'Get A Quote',
])

<section class="contact-section fix section-padding">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif

        <div class="contact-wrapper-2">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <div class="contact-content">
                        <h2>Get A Quote</h2>
                        <p>
                            @if($selectedService)
                                You are requesting a quote for <strong>{{ $selectedService->title }}</strong>.
                                Fill the form and our team will contact you shortly.
                            @else
                                Tell us about your project. Select a service and send your requirements —
                                the selected service will be included in your quote email.
                            @endif
                        </p>

                        @if($selectedService)
                            <div class="mt-4" style="background:var(--bg);padding:20px;border-radius:12px;">
                                <h4 style="margin-bottom:8px;">{{ $selectedService->title }}</h4>
                                @if($selectedService->short_description)
                                    <p style="margin:0;">{{ $selectedService->short_description }}</p>
                                @endif
                            </div>
                        @endif

                        @if($selectedPlan)
                            <div class="mt-3" style="background:var(--bg);padding:20px;border-radius:12px;">
                                <h4 style="margin-bottom:8px;">Plan: {{ $selectedPlan->name }}</h4>
                                <p style="margin:0;">
                                    {{ $selectedPlan->displayPrice() }}
                                    <span>{{ $selectedPlan->displaySuffix() }}</span>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-content">
                        <form action="{{ route('quote.submit') }}" method="POST" class="contact-form-items" id="quote-form">
                            @csrf
                            <div class="row g-4">
                                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".2s">
                                    <div class="form-clt">
                                        <span>Your name*</span>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
                                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                                    <div class="form-clt">
                                        <span>Your Email*</span>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email" required>
                                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".4s">
                                    <div class="form-clt">
                                        <span>Phone</span>
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone Number">
                                        @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                    <div class="form-clt">
                                        <span>Service*</span>
                                        <select name="service_id" required style="width:100%;height:60px;border:1px solid var(--border);padding:0 20px;border-radius:8px;background:#fff;">
                                            <option value="">Select Service</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}" @selected(old('service_id', $selectedService?->id) == $service->id)>
                                                    {{ $service->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('service_id')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                @if($plans->isNotEmpty())
                                    <div class="col-lg-12 wow fadeInUp" data-wow-delay=".55s">
                                        <div class="form-clt">
                                            <span>Pricing Plan (optional)</span>
                                            <select name="plan_id" style="width:100%;height:60px;border:1px solid var(--border);padding:0 20px;border-radius:8px;background:#fff;">
                                                <option value="">Select Plan (optional)</option>
                                                @foreach($plans as $plan)
                                                    <option value="{{ $plan->id }}" @selected(old('plan_id', $selectedPlan?->id) == $plan->id)>
                                                        {{ $plan->name }} — {{ $plan->displayPrice() }} ({{ $plan->displaySuffix() }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('plan_id')<small class="text-danger">{{ $message }}</small>@enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-12 wow fadeInUp" data-wow-delay=".6s">
                                    <div class="form-clt">
                                        <span>Project Details*</span>
                                        <textarea name="message" placeholder="Tell us about your requirements" required>{{ old('message') }}</textarea>
                                        @error('message')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-7 wow fadeInUp" data-wow-delay=".7s">
                                    <button type="submit" class="theme-btn">
                                        Send Quote Request <i class="fa-solid fa-arrow-right-long"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
