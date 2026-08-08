@extends('layouts.frontend')

@section('content')
{{-- HOME 02 --}}
<section class="hero-section hero-2 fix">
    <div class="container">
        <div class="row align-items-center g-4" style="min-height:70vh;padding:100px 0 60px;">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h6 class="wow fadeInUp" style="color:var(--theme);font-weight:600;margin-bottom:12px;">
                        {{ $home['hero_subtitle'] ?? 'Welcome to '.$settings->site_name }}
                    </h6>
                    <h1 class="wow fadeInUp" data-wow-delay=".2s" style="font-size:clamp(2rem,5vw,3.5rem);line-height:1.15;margin-bottom:20px;">
                        {{ $home['hero_title'] ?? 'Smart IT Solutions For Your Growing Business' }}
                    </h1>
                    <p class="wow fadeInUp" data-wow-delay=".3s" style="color:var(--text);margin-bottom:28px;">
                        {{ $home['about_text'] ?? ($settings->tagline ?: 'We deliver cutting-edge technology services to help you scale faster.') }}
                    </p>
                    <a href="{{ $home['hero_cta_url'] ?? route('contact') }}" class="gt-btn wow fadeInUp" data-wow-delay=".4s">
                        <span>{{ $home['hero_cta_text'] ?? 'Get A Quote' }} <i class="fa-solid fa-arrow-right-long"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img class="wow fadeInUp" data-wow-delay=".3s"
                     src="{{ !empty($home['hero_image']) ? asset('storage/'.$home['hero_image']) : asset('assets/img/hero/heroThumb1_1.png') }}"
                     alt="hero" style="max-width:100%;">
            </div>
        </div>
    </div>
</section>

@include('frontend.partials.home-services')
@include('frontend.partials.home-about')
@include('frontend.partials.home-team')
@include('frontend.partials.home-cta')
@endsection
