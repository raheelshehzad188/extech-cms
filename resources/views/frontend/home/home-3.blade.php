@extends('layouts.frontend')

@section('content')
@php
    use App\Models\SiteSetting;
    $slides = $home['hero_slides'] ?? [];
    if (empty($slides)) {
        $slides = [
            [
                'image' => 'assets/img/hero/hero-2.jpg',
                'subtitle' => 'best it company',
                'title' => "Get Our Business\nThis It Solution",
                'text' => 'Consectetur adipiscing elit aenean scelerisque at augue vitae consequat quisque eget congue velit in cursus leo sed sodales est eget turpis.',
                'btn1_text' => 'Explore More',
                'btn1_url' => route('about'),
                'btn2_text' => 'Contact Us',
                'btn2_url' => route('contact'),
            ],
            [
                'image' => 'assets/img/hero/hero-1.jpg',
                'subtitle' => 'best it company',
                'title' => "Get Our Business\nThis It Solution",
                'text' => 'Consectetur adipiscing elit aenean scelerisque at augue vitae consequat quisque eget congue velit in cursus leo sed sodales est eget turpis.',
                'btn1_text' => 'Explore More',
                'btn1_url' => route('about'),
                'btn2_text' => 'Contact Us',
                'btn2_url' => route('contact'),
            ],
            [
                'image' => 'assets/img/hero/hero-3.jpg',
                'subtitle' => 'best it company',
                'title' => "Get Our Business\nThis It Solution",
                'text' => 'Consectetur adipiscing elit aenean scelerisque at augue vitae consequat quisque eget congue velit in cursus leo sed sodales est eget turpis.',
                'btn1_text' => 'Explore More',
                'btn1_url' => route('about'),
                'btn2_text' => 'Contact Us',
                'btn2_url' => route('contact'),
            ],
        ];
    }
    $aboutChecks = $home['about_checklist'] ?? [
        'Branding and design Identity',
        'Web site Marketing Solutions',
        'Unlimited Download Data',
    ];
    $processSteps = $home['process_steps'] ?? [
        ['title' => 'Choose A Service', 'text' => 'In a free hour, when our power of choice is untrammeled and', 'icon' => 'assets/img/process/01.svg'],
        ['title' => 'Define Requirements', 'text' => 'In a free hour, when our power of choice is untrammeled and', 'icon' => 'assets/img/process/02.svg'],
        ['title' => 'Request A Meeting', 'text' => 'In a free hour, when our power of choice is untrammeled and', 'icon' => 'assets/img/process/03.svg'],
        ['title' => 'Final Solution', 'text' => 'In a free hour, when our power of choice is untrammeled and', 'icon' => 'assets/img/process/04.svg'],
    ];
    $achievements = $home['achievements'] ?? [
        ['number' => '6,561', 'label' => 'Satisfied Clients', 'icon' => 'assets/img/achievement-icon/01.svg'],
        ['number' => '600', 'label' => 'Finished Projects', 'icon' => 'assets/img/achievement-icon/02.svg'],
        ['number' => '250', 'label' => 'Skilled Experts', 'icon' => 'assets/img/achievement-icon/03.svg'],
        ['number' => '590', 'label' => 'Media Posts', 'icon' => 'assets/img/achievement-icon/04.svg'],
    ];
    $marque = array_filter(array_map('trim', explode(',', $home['marque_items'] ?? 'Cyber Security,IT Solution,Technology,Data Security')));
@endphp

{{-- Hero Slider (Home 03) --}}
<section class="hero-section fix hero-3">
    <div class="bottom-shape">
        <img src="{{ asset('assets/img/hero/bottom-shape.png') }}" alt="shape-img">
    </div>
    <div class="array-button">
        <button class="array-prev"><i class="fal fa-arrow-right"></i></button>
        <button class="array-next"><i class="fal fa-arrow-left"></i></button>
    </div>
    <div class="swiper hero-slider">
        <div class="swiper-wrapper">
            @foreach($slides as $slide)
                @php
                    $bg = SiteSetting::mediaUrl($slide['image'] ?? null, 'assets/img/hero/hero-2.jpg');
                @endphp
                <div class="swiper-slide">
                    <div class="slider-image bg-cover" style="background-image: url('{{ $bg }}');">
                        <div class="mask-shape" data-animation="slideInDown" data-duration="3s" data-delay="2s">
                            <img src="{{ asset('assets/img/hero/mask-shape-2.png') }}" alt="shape-img">
                        </div>
                        <div class="border-shape" data-animation="slideInRight" data-duration="3s" data-delay="2.2s">
                            <img src="{{ asset('assets/img/hero/border-shape.png') }}" alt="shape-img">
                        </div>
                        <div class="circle-shape" data-animation="slideInRight" data-duration="3s" data-delay="2.1s">
                            <img src="{{ asset('assets/img/choose/circle.png') }}" alt="shape-img">
                        </div>
                        <div class="frame" data-animation="slideInLeft" data-duration="3s" data-delay="2.2s">
                            <img src="{{ asset('assets/img/frame.png') }}" alt="shape-img">
                        </div>
                    </div>
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-8">
                                <div class="hero-content">
                                    <h5 data-animation="slideInRight" data-duration="2s" data-delay=".3s">
                                        {{ $slide['subtitle'] ?? 'best it company' }}
                                    </h5>
                                    <h1 data-animation="slideInRight" data-duration="2s" data-delay=".5s">
                                        {!! nl2br(e($slide['title'] ?? 'Get Our Business This It Solution')) !!}
                                    </h1>
                                    <p data-animation="slideInRight" data-duration="2s" data-delay=".9s">
                                        {{ $slide['text'] ?? '' }}
                                    </p>
                                    <div class="hero-button">
                                        <a href="{{ $slide['btn1_url'] ?? route('about') }}" data-animation="slideInRight" data-duration="2s" data-delay=".9s" class="theme-btn hover-white">
                                            {{ $slide['btn1_text'] ?? 'Explore More' }}
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                        <a href="{{ $slide['btn2_url'] ?? route('contact') }}" data-animation="slideInRight" data-duration="2s" data-delay=".9s" class="theme-btn border-white">
                                            {{ $slide['btn2_text'] ?? 'Contact Us' }}
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- About --}}
<section class="about-section section-padding fix bg-cover" id="about">
    <div class="container">
        <div class="about-wrapper-2">
            <div class="row">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="about-image">
                        <div class="shape-image">
                            <img src="{{ asset('assets/img/about/shape.png') }}" alt="shape-img">
                        </div>
                        <div class="circle-shape">
                            <img src="{{ asset('assets/img/about/circle.png') }}" alt="shape-img">
                        </div>
                        <img src="{{ SiteSetting::mediaUrl($home['about_image'] ?? null, 'assets/img/about/05.png') }}" alt="about-img">
                        <div class="video-box">
                            <a href="{{ $home['about_video_url'] ?? 'https://www.youtube.com/watch?v=Cn4G2lZ_g2I' }}" class="video-btn ripple popup-video">
                                <i class="fa-solid fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="about-content">
                        <div class="section-title mb-3 mxw-650">
                            <div class="subtitle">
                                <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                                <span>{{ $home['about_subtitle'] ?? 'ABOUT EXTECH' }}</span>
                                <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                            </div>
                            <h2 class="title">{{ $home['about_title'] ?? 'We Can Clients with the About Solution' }}</h2>
                        </div>
                        <p class="wow fadeInUp" data-wow-delay=".5s">
                            {{ $home['about_text'] ?? 'It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point.' }}
                        </p>
                        <div class="icon-area wow fadeInUp" data-wow-delay=".7s">
                            <ul class="list">
                                @foreach($aboutChecks as $check)
                                    <li>
                                        <i class="fa-solid fa-check"></i>
                                        {{ is_array($check) ? ($check['item'] ?? reset($check)) : $check }}
                                    </li>
                                @endforeach
                            </ul>
                            <div class="icon-items">
                                <div class="content">
                                    <h2><span class="counter-number">{{ $home['about_clients_count'] ?? '6,561' }}</span>+</h2>
                                    <span>{{ $home['about_clients_label'] ?? 'Satisfied Clients' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="about-author">
                            <div class="about-button wow fadeInUp" data-wow-delay=".8s">
                                <a href="{{ $home['about_cta_url'] ?? route('about') }}" class="theme-btn">
                                    {{ $home['about_cta_text'] ?? 'Explore More' }}
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>
                            <div class="author-icon wow fadeInUp" data-wow-delay=".9s">
                                <div class="icon"><i class="fa-solid fa-phone"></i></div>
                                <div class="content">
                                    <span>Call Us Now</span>
                                    <h5>
                                        <a href="tel:{{ preg_replace('/\s+/', '', $home['about_phone'] ?? $settings->phone ?? '') }}">
                                            {{ $home['about_phone'] ?? $settings->phone }}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Brand --}}
@if(($brands ?? collect())->isNotEmpty())
<div class="brand-section fix section-padding pt-0">
    <div class="container">
        <div class="brand-wrapper">
            <h6 class="text-center wow fadeInUp" data-wow-delay=".3s">{{ $home['brand_text'] ?? '1k + Brands Trust Us' }}</h6>
            <div class="swiper brand-slider">
                <div class="swiper-wrapper">
                    @foreach($brands as $brand)
                        <div class="swiper-slide">
                            <div class="brand-image">
                                @if($brand->url)
                                    <a href="{{ $brand->url }}" target="_blank" rel="noopener">
                                        <img src="{{ $brand->logoUrl() }}" alt="{{ $brand->name }}">
                                    </a>
                                @else
                                    <img src="{{ $brand->logoUrl() }}" alt="{{ $brand->name }}">
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Services --}}
<section class="service-section-3 pb-0 fix section-padding bg-cover"
    style="background-image: url('{{ asset('assets/img/service/service-bg-3.jpg') }}');" id="service">
    <div class="container">
        <div class="row d-flex align-items-end justify-content-between mb-20">
            <div class="col-xl-7">
                <div class="section-title mxw-650">
                    <div class="subtitle">
                        <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                        <span>{{ $home['services_subtitle'] ?? 'What We Do' }}</span>
                        <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                    </div>
                    <h2 class="title">{{ $home['services_title'] ?? 'We Solve IT Problems With Technology' }}</h2>
                </div>
            </div>
            <div class="col-xl-5 d-flex align-items-end justify-content-end">
                <div class="btn-wrapper" data-wow-delay=".9s">
                    <a href="{{ route('services.index') }}" class="theme-btn">
                        {{ $home['services_cta_text'] ?? 'See all Services' }}
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($services->take(4) as $service)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="service-card-items">
                        <div class="service-image">
                            <img src="{{ $service->imageUrl() ?: asset('assets/img/service/0'.(($loop->index % 4) + 2).'.jpg') }}" alt="{{ $service->title }}">
                        </div>
                        <div class="service-content">
                            @if($service->icon)
                                <div class="icon"><i class="{{ $service->icon }}" style="font-size:2rem;color:var(--theme);"></i></div>
                            @endif
                            <h4><a href="{{ route('services.show', $service) }}">{{ $service->title }}</a></h4>
                            <p>{{ $service->short_description }}</p>
                            <a href="{{ route('quote', $service) }}" class="theme-btn-2 mt-3">
                                Get A Quote <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="cta-banner-2 section-padding">
        <div class="container">
            <div class="cta-wrapper-2 border-radius">
                <h3>{{ $home['cta_title'] ?? 'Stay Connected With Cutting Edge IT' }}</h3>
                <div class="author-icon">
                    <div class="icon"><i class="fa-solid fa-phone"></i></div>
                    <div class="content">
                        <span>Call Us Now</span>
                        <h4>
                            <a href="tel:{{ preg_replace('/\s+/', '', $home['cta_phone'] ?? $settings->phone ?? '') }}">
                                {{ $home['cta_phone'] ?? $settings->phone }}
                            </a>
                        </h4>
                    </div>
                </div>
                <a href="{{ route('quote') }}" class="theme-btn bg-white">
                    {{ $settings->header_cta_text ?: 'get A Quote' }}
                    <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@include('frontend.partials.home-pricing')

{{-- Work Process --}}
<section class="work-process-section fix section-padding pt-0">
    <div class="container">
        <div class="section-title title-area mx-auto mb-25">
            <div class="subtitle d-flex justify-content-center">
                <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                <span>{{ $home['process_subtitle'] ?? 'How IT work' }}</span>
                <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
            </div>
            <h2 class="title text-center">{{ $home['process_title'] ?? 'Standard Work Process' }}</h2>
        </div>
        <div class="process-work-wrapper">
            <div class="line-shape">
                <img src="{{ asset('assets/img/process/linepng.png') }}" alt="">
            </div>
            <div class="row">
                @foreach($processSteps as $i => $step)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="work-process-items text-center">
                            @if($i % 2 === 1)
                                <div class="content style-2">
                                    <h4>{{ $step['title'] ?? '' }}</h4>
                                    <p>{{ $step['text'] ?? '' }}</p>
                                </div>
                            @endif
                            <div class="icon">
                                <img src="{{ SiteSetting::mediaUrl($step['icon'] ?? null, 'assets/img/process/0'.($i+1).'.svg') }}" alt="img">
                                <h6 class="number">{{ $i + 1 }}</h6>
                            </div>
                            @if($i % 2 === 0)
                                <div class="content">
                                    <h4>{{ $step['title'] ?? '' }}</h4>
                                    <p>{{ $step['text'] ?? '' }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Achievements --}}
<section class="achievement-section-3 fix section-bg-2">
    <div class="shape-image">
        <img src="{{ asset('assets/img/achiv-shape.png') }}" alt="shape-img">
    </div>
    <div class="container">
        <div class="achievement-wrapper style-2">
            <div class="section-title mxw-560">
                <div class="subtitle text-white wow fadeInUp" data-wow-delay=".3s">
                    <img src="{{ asset('assets/img/icon/arrowLeftWhite.svg') }}" alt="icon">
                    <span class="text-white">{{ $home['achievement_subtitle'] ?? 'achievement' }}</span>
                    <img src="{{ asset('assets/img/icon/arrowRightWhite.svg') }}" alt="icon">
                </div>
                <h2 class="title text-white wow fadeInUp" data-wow-delay=".6s">
                    {{ $home['achievement_title'] ?? 'We Are Increasing Business Success' }}
                </h2>
            </div>
            <div class="counter-area">
                @foreach($achievements as $item)
                    <div class="counter-items wow fadeInUp" data-wow-delay=".{{ ($loop->index * 2) + 3 }}s">
                        <div class="icon">
                            <img src="{{ SiteSetting::mediaUrl($item['icon'] ?? null, 'assets/img/achievement-icon/0'.($loop->index+1).'.svg') }}" alt="icon-img">
                        </div>
                        <div class="content">
                            <h2><span class="counter-number">{{ $item['number'] ?? '0' }}</span>+</h2>
                            <p>{{ $item['label'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Projects --}}
<section class="project-section-3 section-padding pb-0 fix bg-cover"
    style="background-image: url('{{ asset('assets/img/testimonial/bg.jpg') }}');">
    <div class="container">
        <div class="row gy-5 gx-70 d-flex align-items-center mb-20">
            <div class="col-xl-6">
                <div class="section-title mxw-560 z-5">
                    <div class="subtitle text-white wow fadeInUp" data-wow-delay=".3s">
                        <img src="{{ asset('assets/img/icon/arrowLeftWhite.svg') }}" alt="icon">
                        <span class="text-white">{{ $home['projects_subtitle'] ?? 'PROJECTS' }}</span>
                        <img src="{{ asset('assets/img/icon/arrowRightWhite.svg') }}" alt="icon">
                    </div>
                    <h2 class="title text-white wow fadeInUp" data-wow-delay=".6s">
                        {{ $home['projects_title'] ?? "Our Latest Incredible Client's Projects" }}
                    </h2>
                </div>
            </div>
            <div class="col-xl-6 d-flex justify-content-start justify-content-md-end">
                <div class="title-video-box">
                    <a href="{{ $home['projects_video_url'] ?? 'https://www.youtube.com/watch?v=Cn4G2lZ_g2I' }}" class="video-btn ripple popup-video">
                        <i class="fa-solid fa-play"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="project-wrapper style-2">
            <div class="swiper project-slider-3">
                <div class="swiper-wrapper">
                    @forelse($projects->take(4) as $project)
                        <div class="swiper-slide">
                            <div class="project-items style-2">
                                <div class="project-image">
                                    <img src="{{ $project->imageUrl() ?: asset('assets/img/project/'.str_pad((string) (8 + $loop->index), 2, '0', STR_PAD_LEFT).'.jpg') }}" alt="{{ $project->title }}">
                                    <div class="project-content style3">
                                        <p>{{ $project->category ?: 'Technology' }}</p>
                                        <h4><a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a></h4>
                                        <a href="{{ route('projects.show', $project) }}" class="arrow-icon-2">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        @for($i = 8; $i <= 11; $i++)
                            <div class="swiper-slide">
                                <div class="project-items style-2">
                                    <div class="project-image">
                                        <img src="{{ asset('assets/img/project/'.str_pad((string) $i, 2, '0', STR_PAD_LEFT).'.jpg') }}" alt="project-img">
                                        <div class="project-content style3">
                                            <p>Technology</p>
                                            <h4><a href="{{ route('projects.index') }}">Project {{ $i }}</a></h4>
                                            <a href="{{ route('projects.index') }}" class="arrow-icon-2"><i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endforelse
                </div>
            </div>
        </div>
        <div class="swiper-dot-2 mr-left"><div class="dot-2"></div></div>
    </div>
</section>

{{-- Marquee --}}
<div class="marque-section section-padding">
    <div class="container-fluid">
        <div class="marquee-wrapper style-2 text-slider">
            <div class="marquee-inner to-left">
                <ul class="marqee-list d-flex">
                    <li class="marquee-item style-2">
                        @foreach(array_merge($marque, $marque, $marque) as $word)
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span>
                            <span class="text-slider text-style">{{ $word }}</span>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Team --}}
<section class="team-section-3 fix section-padding section-bg" id="team">
    <div class="line-shape"><img src="{{ asset('assets/img/team/line-shape.png') }}" alt="shape-img"></div>
    <div class="mask-shape"><img src="{{ asset('assets/img/team/mask-shape-2.png') }}" alt="shape-img"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-between mb-30">
            <div class="col-xl-7">
                <div class="section-title mxw-650">
                    <div class="subtitle">
                        <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                        <span>{{ $home['team_subtitle'] ?? 'Team Members' }}</span>
                        <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                    </div>
                    <h2 class="title">{{ $home['team_title'] ?? 'Our Dedicated Team Members' }}</h2>
                </div>
            </div>
            <div class="col-xl-5 d-flex justify-content-start justify-content-lg-end">
                <div class="btn-wrapper mt-3 mt-lg-0">
                    <a href="{{ route('team.index') }}" class="theme-btn">
                        All Members <i class="fa-sharp fa-regular fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($team->take(4) as $member)
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".{{ ($loop->index * 2) + 3 }}s">
                    <div class="single-team-items">
                        <div class="team-image">
                            <img src="{{ $member->imageUrl() ?: asset('assets/img/team/0'.(4 + $loop->index).'.jpg') }}" alt="{{ $member->name }}">
                            <div class="social-profile">
                                <ul>
                                    @if($member->facebook)<li><a href="{{ $member->facebook }}"><i class="fab fa-facebook-f"></i></a></li>@endif
                                    @if($member->twitter)<li><a href="{{ $member->twitter }}"><i class="fa-brands fa-twitter"></i></a></li>@endif
                                    @if($member->linkedin)<li><a href="{{ $member->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>@endif
                                </ul>
                                <span class="plus-btn"><i class="fas fa-share-alt"></i></span>
                            </div>
                        </div>
                        <div class="team-content text-center">
                            <h3><a href="{{ route('team.show', $member) }}">{{ $member->name }}</a></h3>
                            <p>{{ $member->designation }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Testimonials --}}
<section class="tesimonial-section-3 section-padding section-bg-2 bg-cover">
    <div class="line-shape"><img src="{{ asset('assets/img/team/line-shape.png') }}" alt="shape-img"></div>
    <div class="mask-shape"><img src="{{ asset('assets/img/team/mask-shape.png') }}" alt="shape-img"></div>
    <div class="array-button">
        <button class="array-prev"><i class="fal fa-arrow-left"></i></button>
        <button class="array-next"><i class="fal fa-arrow-right"></i></button>
    </div>
    <div class="container">
        <div class="section-title title-area mx-auto mb-20">
            <div class="subtitle d-flex justify-content-center">
                <img src="{{ asset('assets/img/icon/arrowLeftWhite.svg') }}" alt="icon">
                <span class="text-white">{{ $home['testimonial_subtitle'] ?? 'Testimonials' }}</span>
                <img src="{{ asset('assets/img/icon/arrowRightWhite.svg') }}" alt="icon">
            </div>
            <h2 class="title text-center text-white">{{ $home['testimonial_title'] ?? 'People Who Already Love Us' }}</h2>
        </div>
        <div class="swiper testimonial-slider-2">
            <div class="swiper-wrapper">
                @foreach([
                    ['name' => 'Kathryn Murphy', 'role' => 'Web Designer', 'img' => '02.jpg'],
                    ['name' => 'Albert Flores', 'role' => 'Medical Assistant', 'img' => '03.jpg'],
                ] as $t)
                    <div class="swiper-slide">
                        <div class="testimonial-box-items">
                            <div class="icon"><img src="{{ asset('assets/img/testimonial/icon.png') }}" alt="icon-img"></div>
                            <div class="client-items">
                                <div class="client-image style-2 bg-cover" style="background-image: url('{{ asset('assets/img/testimonial/'.$t['img']) }}');"></div>
                                <div class="client-content">
                                    <h4>{{ $t['name'] }}</h4>
                                    <p>{{ $t['role'] }}</p>
                                    <div class="star">
                                        @for($s=0;$s<5;$s++)<i class="fas fa-star"></i>@endfor
                                    </div>
                                </div>
                            </div>
                            <p>Consectetur adipiscing elit. Integer nunc viverra laoreet est the is porta pretium metus aliquam eget maecenas porta is nunc viverra Aenean pulvinar maximus leo</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Blog --}}
<section class="news-section-3 fix section-padding" id="news">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-between mb-20">
            <div class="col-xl-7">
                <div class="section-title mxw-650">
                    <div class="subtitle">
                        <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                        <span>{{ $home['blog_subtitle'] ?? 'Latest Blog' }}</span>
                        <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                    </div>
                    <h2 class="title">{{ $home['blog_title'] ?? 'Checkout Our Latest News & Articles' }}</h2>
                </div>
            </div>
            <div class="col-xl-5 d-flex justify-content-end">
                <div class="array-button">
                    <button class="array-next"><i class="fal fa-arrow-left"></i></button>
                    <button class="array-prev"><i class="fal fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="swiper news-slider">
            <div class="swiper-wrapper">
                @forelse($posts->take(3) as $post)
                    <div class="swiper-slide">
                        <div class="news-card-items style-2">
                            <div class="news-image">
                                <img src="{{ $post->imageUrl() ?: asset('assets/img/news/0'.(4 + $loop->index).'.jpg') }}" alt="{{ $post->title }}">
                                <div class="post-date">
                                    <h3>
                                        {{ optional($post->published_at)->format('d') ?? '17' }} <br>
                                        <span>{{ optional($post->published_at)->format('M') ?? 'Feb' }}</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="news-content">
                                <ul>
                                    <li><i class="fa-regular fa-user"></i> {{ $post->author_name ?: 'By Admin' }}</li>
                                    <li><i class="fa-solid fa-tag"></i> {{ $post->category ?: 'IT Services' }}</li>
                                </ul>
                                <h3><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h3>
                                <a href="{{ route('blog.show', $post) }}" class="theme-btn-2 mt-3">
                                    read More <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    @foreach(['04.jpg','07.jpg','08.jpg'] as $img)
                        <div class="swiper-slide">
                            <div class="news-card-items style-2">
                                <div class="news-image">
                                    <img src="{{ asset('assets/img/news/'.$img) }}" alt="news-img">
                                </div>
                                <div class="news-content">
                                    <h3><a href="{{ route('blog.index') }}">Latest IT Insights</a></h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
