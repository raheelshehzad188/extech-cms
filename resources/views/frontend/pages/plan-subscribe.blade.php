@extends('layouts.frontend')

@section('content')
@include('frontend.partials.breadcrumb', [
    'title' => 'Buy Package',
    'subtitle' => $plan->name,
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
                        <h2>{{ $plan->name }}</h2>
                        <p>One-time package payment. Fill the form and our team will contact you with payment details.</p>

                        <div class="mt-4" style="background:var(--bg);padding:24px;border-radius:12px;">
                            <h3 style="margin-bottom:8px;">{{ $plan->displayPrice() }}</h3>
                            <p style="margin:0;color:var(--theme);font-weight:600;">{{ $plan->displaySuffix() }}</p>

                            @if($plan->featureList())
                                <ul class="mt-3" style="padding-left:18px;">
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
                        <form action="{{ route('plan.subscribe.submit', $plan) }}" method="POST" class="contact-form-items">
                            @csrf
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>Your name*</span>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
                                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>Your Email*</span>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email" required>
                                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>Phone</span>
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone Number">
                                        @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-clt">
                                        <span>Company</span>
                                        <input type="text" name="company" value="{{ old('company') }}" placeholder="Company (optional)">
                                        @error('company')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-clt">
                                        <span>Message</span>
                                        <textarea name="message" placeholder="Any requirements or notes">{{ old('message') }}</textarea>
                                        @error('message')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <button type="submit" class="theme-btn">
                                        Request One-Time Package <i class="fa-solid fa-arrow-right-long"></i>
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
