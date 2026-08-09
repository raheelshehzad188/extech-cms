@extends('layouts.frontend')

@section('content')
{{-- HOME 01 --}}
<section class="hero-section fix">
    <div class="hero-wrapper style1">
        <div class="container">
            <div class="hero-main-container style1 border-radius">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-6 order-2 order-xl-1">
                            <div class="hero-content style1">
                                <h6 class="subtitle">
                                    <img src="{{ asset('assets/img/icon/subtitleIcon1_1.svg') }}" alt="icon">
                                    {{ $home['hero_subtitle'] ?? 'Everything You Need to Create a Website' }}
                                </h6>
                                <h1>{{ $home['hero_title'] ?? 'Business Innovation With IT Services Expertise' }}</h1>
                                @php
                                    $checklist = $home['hero_checklist'] ?? [
                                        'Deployment and Support',
                                        'Discovery and Analysis',
                                        'Flexibility and Adaptability',
                                        'Competitive Advantage',
                                    ];
                                @endphp
                                <div class="checklist-wrapper style3">
                                    <ul class="checklist style3">
                                        @foreach(array_slice($checklist, 0, (int) ceil(count($checklist)/2)) as $item)
                                            <li>
                                                <img src="{{ asset('assets/img/icon/checkmarkIcon2.svg') }}" alt="icon">
                                                {{ is_array($item) ? ($item['item'] ?? reset($item)) : $item }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul class="checklist style3">
                                        @foreach(array_slice($checklist, (int) ceil(count($checklist)/2)) as $item)
                                            <li>
                                                <img src="{{ asset('assets/img/icon/checkmarkIcon2.svg') }}" alt="icon">
                                                {{ is_array($item) ? ($item['item'] ?? reset($item)) : $item }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="contact-meta">
                                    <div class="btn-wrapper">
                                        <a href="{{ $home['hero_cta_url'] ?? route('contact') }}" class="gt-btn style4">
                                            {{ $home['hero_cta_text'] ?? 'Get Started' }}
                                            <i class="fa-sharp fa-regular fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 order-1 order-xl-2">
                            <div class="hero-thumb style1">
                                <div class="main-thumb">
                                    <img src="{{ !empty($home['hero_image']) ? asset('storage/'.$home['hero_image']) : asset('assets/img/hero/heroThumb1_1.png') }}" alt="hero">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.partials.home-services')
@include('frontend.partials.home-pricing')
@include('frontend.partials.home-about')
@include('frontend.partials.home-team')
@include('frontend.partials.home-cta')
@endsection
