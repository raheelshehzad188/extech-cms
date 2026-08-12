@extends('layouts.frontend')

@section('content')
@include('frontend.partials.breadcrumb', [
    'title' => 'Plan Request',
    'subtitle' => $plan->name,
    'banner_image' => $seo->banner_image ?? null,
])

<section class="contact-section fix section-padding">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning mb-4">{{ session('warning') }}</div>
        @endif

        <div class="contact-wrapper-2">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <div class="contact-content">
                        <h2>Get Started</h2>
                        <p>
                            You selected <strong>{{ $plan->name }}</strong>.
                            Fill this form and our team will contact you with next steps and payment details.
                        </p>

                        <div class="mt-4" style="background:var(--bg);padding:24px;border-radius:12px;">
                            <h3 style="margin-bottom:8px;color:var(--title-color);">{{ $plan->name }}</h3>
                            <h3 style="margin-bottom:8px;">{{ $plan->displayPrice() }}</h3>
                            <p style="margin:0;color:var(--theme);font-weight:600;">{{ $plan->displaySuffix() }}</p>

                            @if($plan->featureList())
                                <ul class="mt-3" style="padding-left:18px;color:var(--text-color,#445375);">
                                    @foreach($plan->featureList() as $feature)
                                        <li style="margin-bottom:6px;{{ $feature['included'] ? '' : 'opacity:.55;text-decoration:line-through;' }}">
                                            {{ $feature['text'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-content">
                        <form action="{{ route('plan.subscribe.submit', $plan) }}" method="POST" class="contact-form-items" id="planRequestForm">
                            @csrf
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>Name*</span>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
                                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>Email*</span>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email" required>
                                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>Contact*</span>
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone / Contact" required>
                                        @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>WhatsApp*</span>
                                        <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="WhatsApp Number" required>
                                        @error('whatsapp')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>Business Name*</span>
                                        <input type="text" name="business_name" value="{{ old('business_name') }}" placeholder="Business Name" required>
                                        @error('business_name')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>Website</span>
                                        <input type="url" name="website" value="{{ old('website') }}" placeholder="https://example.com">
                                        @error('website')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>Country*</span>
                                        <input type="text" name="country" value="{{ old('country') }}" placeholder="Country" required>
                                        @error('country')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>Plan Price</span>
                                        <input type="text" value="{{ $plan->displayPrice() }} {{ $plan->displaySuffix() }}" readonly style="background:#f5f7fb;">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-clt">
                                        <span>Address*</span>
                                        <textarea name="address" placeholder="Full Address" required>{{ old('address') }}</textarea>
                                        @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-clt">
                                        <span>Message / Notes</span>
                                        <textarea name="message" placeholder="Any requirements or notes (optional)">{{ old('message') }}</textarea>
                                        @error('message')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <button type="submit" class="theme-btn">
                                        Submit Request <i class="fa-solid fa-arrow-right-long"></i>
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
