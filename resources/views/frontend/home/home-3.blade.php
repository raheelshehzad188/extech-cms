@extends('layouts.frontend')

@section('content')
{{-- HOME 03 --}}
<section class="hero-section hero-3 fix" style="background:linear-gradient(135deg, var(--theme2), var(--theme));color:#fff;padding:120px 0 80px;">
    <div class="container text-center">
        <h6 class="wow fadeInUp" style="letter-spacing:.08em;text-transform:uppercase;opacity:.9;margin-bottom:16px;">
            {{ $home['hero_subtitle'] ?? $settings->site_name }}
        </h6>
        <h1 class="wow fadeInUp" data-wow-delay=".2s" style="font-size:clamp(2.2rem,6vw,4rem);max-width:900px;margin:0 auto 24px;color:#fff;">
            {{ $home['hero_title'] ?? 'Technology That Powers Digital Transformation' }}
        </h1>
        <p class="wow fadeInUp" data-wow-delay=".3s" style="max-width:640px;margin:0 auto 32px;opacity:.9;">
            {{ $home['about_text'] ?? ($settings->tagline ?: 'Build, scale and innovate with a trusted IT partner.') }}
        </p>
        <a href="{{ $home['hero_cta_url'] ?? route('contact') }}" class="gt-btn style4 wow fadeInUp" data-wow-delay=".4s">
            {{ $home['hero_cta_text'] ?? 'Start a Project' }}
            <i class="fa-solid fa-arrow-right-long"></i>
        </a>
    </div>
</section>

@include('frontend.partials.home-services')
@include('frontend.partials.home-about')
@include('frontend.partials.home-team')
@include('frontend.partials.home-cta')
@endsection
