@extends('layouts.frontend')

@section('content')
@php
    use App\Models\SiteSetting;

    $checklist = $home['hero_checklist'] ?? [
        'Deployment and Support',
        'Discovery and Analysis',
        'Flexibility and Adaptability',
        'Competitive Advantage',
    ];
    $checklist = collect($checklist)->map(fn ($item) => is_array($item) ? ($item['item'] ?? reset($item)) : $item)->filter()->values()->all();
    $half = (int) ceil(count($checklist) / 2);

    $processSteps = $home['process_steps'] ?? [
        ['number' => '01', 'title' => 'Requirement', 'text' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.'],
        ['number' => '02', 'title' => 'UI/UX Desing', 'text' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.'],
        ['number' => '03', 'title' => 'Prototype', 'text' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.'],
        ['number' => '04', 'title' => 'Development', 'text' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.'],
    ];

    $projectCategories = $home['project_categories'] ?? [
        ['title' => 'Data Analysis', 'icon' => 'assets/img/icon/projectItemIcon1_1.svg'],
        ['title' => 'UI/UX Designing', 'icon' => 'assets/img/icon/projectItemIcon1_2.svg'],
        ['title' => 'App Development', 'icon' => 'assets/img/icon/projectItemIcon1_3.svg'],
        ['title' => 'Wp Development', 'icon' => 'assets/img/icon/projectItemIcon1_4.svg'],
        ['title' => '3D Design Solution', 'icon' => 'assets/img/icon/projectItemIcon1_5.svg'],
    ];

    $testimonials = $home['testimonials'] ?? [];
    $brandLogos = [
        'assets/img/brand-logo/brandLogo1_1.svg',
        'assets/img/brand-logo/brandLogo1_2.svg',
        'assets/img/brand-logo/brandLogo1_3.svg',
        'assets/img/brand-logo/brandLogo1_4.svg',
        'assets/img/brand-logo/brandLogo1_5.svg',
    ];
@endphp

{{-- Hero --}}
<section class="hero-section fix">
    <div class="hero-wrapper style1">
        <div class="shape1_2 d-none d-xxl-block"><img src="{{ asset('assets/img/shape/heroShape1_2.png') }}" alt="shape"></div>
        <div class="shape1_3">
            <a href="{{ $home['hero_cta_url'] ?? route('quote') }}">
                <img class="rotate360" src="{{ asset('assets/img/shape/heroShape1_3.png') }}" alt="shape">
            </a>
        </div>
        <div class="shape1_4 movingX d-none d-xxl-block"><img src="{{ asset('assets/img/shape/heroShape1_4.png') }}" alt="shape"></div>
        <div class="shape1_5 float-bob-y d-none d-xxl-block"><img src="{{ asset('assets/img/shape/heroShape1_5.png') }}" alt="shape"></div>
        <div class="container">
            <div class="hero-main-container style1 border-radius">
                <div class="container">
                    <div class="row d-flex align-items-center align-items-xl-start">
                        <div class="col-xl-6 order-2 order-xl-1">
                            <div class="hero-content style1">
                                <h6 class="subtitle">
                                    <img src="{{ asset('assets/img/icon/subtitleIcon1_1.svg') }}" alt="icon">
                                    {{ $home['hero_subtitle'] ?? 'Everything You Need to Create a Website' }}
                                </h6>
                                <h1>{{ $home['hero_title'] ?? 'Business Innovation With IT Services expertise' }}</h1>
                                <div class="checklist-wrapper style3">
                                    <ul class="checklist style3">
                                        @foreach(array_slice($checklist, 0, $half) as $item)
                                            <li><img src="{{ asset('assets/img/icon/checkmarkIcon2.svg') }}" alt="icon"> {{ $item }}</li>
                                        @endforeach
                                    </ul>
                                    <ul class="checklist style3">
                                        @foreach(array_slice($checklist, $half) as $item)
                                            <li><img src="{{ asset('assets/img/icon/checkmarkIcon2.svg') }}" alt="icon"> {{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="contact-meta">
                                    <div class="btn-wrapper">
                                        <a href="{{ $home['hero_cta_url'] ?? route('quote') }}" class="gt-btn style4">
                                            {{ $home['hero_cta_text'] ?? 'get Started' }}
                                            <i class="fa-sharp fa-regular fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="fancy-box-wrapper style5 wow fadeInUp" data-wow-delay=".9s">
                                    <div class="fancy-box style5">
                                        <div class="title"><img src="{{ asset('assets/img/icon/starIcon1_1.svg') }}" alt="icon"> {{ $home['trustpilot_label'] ?? 'Trustipilot' }}</div>
                                        <div class="item-wrap">
                                            <div class="item"><img src="{{ asset('assets/img/shape/profileShape1_1.png') }}" alt="shape"></div>
                                            <div class="item">
                                                <div class="star-wrapper">
                                                    <img src="{{ asset('assets/img/icon/starIcon1_2.svg') }}" alt="icon">
                                                    <img src="{{ asset('assets/img/icon/starIcon1_2.svg') }}" alt="icon">
                                                    <img src="{{ asset('assets/img/icon/starIcon1_2.svg') }}" alt="icon">
                                                </div>
                                                <h6>{{ $home['trustpilot_reviews'] ?? '450+ reviews' }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fancy-box style5 border-0">
                                        <div class="title">{{ $home['google_label'] ?? 'Google' }}</div>
                                        <div class="item-wrap">
                                            <div class="item"><img src="{{ asset('assets/img/shape/profileShape1_1.png') }}" alt="shape"></div>
                                            <div class="item">
                                                <div class="star-wrapper">
                                                    <img src="{{ asset('assets/img/icon/starIcon1_2.svg') }}" alt="icon">
                                                    <img src="{{ asset('assets/img/icon/starIcon1_2.svg') }}" alt="icon">
                                                    <img src="{{ asset('assets/img/icon/starIcon1_2.svg') }}" alt="icon">
                                                </div>
                                                <h6>{{ $home['google_reviews'] ?? '450+ reviews' }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 order-1 order-xl-2 justify-content-center">
                            <div class="hero-thumb style1">
                                <div class="main-thumb">
                                    <img src="{{ SiteSetting::mediaUrl($home['hero_image'] ?? null, 'assets/img/hero/heroThumb1_1.png') }}" alt="thumb">
                                </div>
                                <div class="shape1_1 d-none d-xxl-block"><img src="{{ asset('assets/img/shape/heroShape1_1.png') }}" alt="shape"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" style="position: absolute;">
                    <clipPath id="heroMask2">
                        <path d="M0 50C0 22.3858 22.3858 0 50 0H1780C1807.61 0 1830 22.3858 1830 50V774C1830 801.614 1807.61 824 1780 824H1042.05C1015.85 824 991.426 810.575 977.326 788.498C947.176 741.292 878.083 741.197 848.055 788.482C834.009 810.601 809.627 824 783.425 824H50C22.3858 824 0 801.614 0 774V50Z" fill="#384BFF"/>
                    </clipPath>
                </svg>
            </div>
        </div>
    </div>
</section>

{{-- Brands --}}
<div class="brand-slider-section fix">
    <div class="brand-slider-container-wrapper style1">
        <div class="container">
            <div class="row">
                <div class="slider-area brandSliderOne">
                    <div class="swiper gt-slider" id="brandSliderOne"
                         data-slider-options='{"loop": true, "breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":2,"centeredSlides":true},"768":{"slidesPerView":3},"992":{"slidesPerView":4},"1200":{"slidesPerView":5}}}'>
                        <div class="swiper-wrapper">
                            @forelse(($brands ?? collect()) as $brand)
                                <div class="swiper-slide">
                                    <div class="brand-logo">
                                        @if($brand->url)
                                            <a href="{{ $brand->url }}" target="_blank" rel="noopener">
                                                <img src="{{ $brand->logoUrl() }}" alt="{{ $brand->name }}">
                                            </a>
                                        @else
                                            <img src="{{ $brand->logoUrl() }}" alt="{{ $brand->name }}">
                                        @endif
                                    </div>
                                </div>
                            @empty
                                @foreach(array_merge($brandLogos, $brandLogos) as $logo)
                                    <div class="swiper-slide">
                                        <div class="brand-logo">
                                            <img src="{{ asset($logo) }}" alt="brandLogo">
                                        </div>
                                    </div>
                                @endforeach
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Services slider --}}
<section class="service-section space fix">
    <div class="service-container-wrapper style1">
        <div class="container">
            <div class="title-wrap mb-45">
                <div class="section-title">
                    <div class="subtitle">
                        <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                        <span>{{ $home['services_subtitle'] ?? 'Our Services' }}</span>
                        <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                    </div>
                    <h2 class="title">{{ $home['services_title'] ?? 'Elevating Businesses with IT Ingenuity' }}</h2>
                </div>
                <div class="arrow-btn text-end wow fadeInUp" data-wow-delay=".9s">
                    <button data-slider-prev="#serviceSliderOne" class="slider-arrow style1"><i class="fa-sharp fa-regular fa-arrow-left-long"></i></button>
                    <button data-slider-next="#serviceSliderOne" class="slider-arrow style1 slider-next"><i class="fa-regular fa-arrow-right-long"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="slider-area serviceSliderOne">
                    <div class="swiper gt-slider" id="serviceSliderOne"
                         data-slider-options='{"loop": true, "breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":2,"centeredSlides":true},"768":{"slidesPerView":2},"992":{"slidesPerView":3},"1200":{"slidesPerView":4}}}'>
                        <div class="swiper-wrapper">
                            @forelse($services as $service)
                                <div class="swiper-slide">
                                    <div class="service-card style1">
                                        <div class="icon">
                                            <img src="{{ asset('assets/img/icon/serviceIcon1_'.(($loop->index % 4) + 1).'.svg') }}" alt="icon">
                                        </div>
                                        <div class="body">
                                            <h3><a href="{{ route('services.show', $service) }}">{{ $service->title }}</a></h3>
                                            <p>{{ $service->short_description }}</p>
                                            <a href="{{ route('quote', $service) }}" class="link-btn style1">
                                                Get A Quote <i class="fa-regular fa-chevrons-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                @foreach(['Data Guard Sentinel','Woo Commerce','CRM Solutions','Web Design'] as $i => $title)
                                    <div class="swiper-slide">
                                        <div class="service-card style1">
                                            <div class="icon"><img src="{{ asset('assets/img/icon/serviceIcon1_'.(($i % 4) + 1).'.svg') }}" alt="icon"></div>
                                            <div class="body">
                                                <h3><a href="{{ route('services.index') }}">{{ $title }}</a></h3>
                                                <p>Collaboratively formulate principle capital. Progressively evolve user revolutionary hosting services.</p>
                                                <a href="{{ route('quote') }}" class="link-btn style1">Get A Quote <i class="fa-regular fa-chevrons-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- About --}}
<section class="about-section space fix bg-theme-color">
    <div class="about-container-wrapper style1">
        <div class="shape1"><img src="{{ asset('assets/img/shape/aboutShape1_1.png') }}" alt="shape"></div>
        <div class="shape2"><img src="{{ asset('assets/img/shape/aboutShape1_2.png') }}" alt="shape"></div>
        <div class="shape3"><img src="{{ asset('assets/img/shape/aboutShape1_3.png') }}" alt="shape"></div>
        <div class="container">
            <div class="row gy-5 gx-70">
                <div class="col-xl-6">
                    <div class="about-thumb">
                        <div class="thumb1">
                            <img class="img-custom-anim-left wow fadeInUp" data-wow-delay=".5s"
                                 src="{{ SiteSetting::mediaUrl($home['about_image'] ?? null, 'assets/img/about/aboutThumb1_1.png') }}" alt="thumb">
                        </div>
                        <div class="thumb2">
                            <img class="img-custom-anim-top wow fadeInUp" data-wow-delay=".8s"
                                 src="{{ SiteSetting::mediaUrl($home['about_image_2'] ?? null, 'assets/img/about/aboutThumb1_2.png') }}" alt="thumb">
                        </div>
                        <div class="shape">
                            <a href="{{ $home['about_cta_url'] ?? route('contact') }}">
                                <img class="rotate360" src="{{ asset('assets/img/shape/aboutShape1_4.png') }}" alt="shape">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about-content">
                        <div class="section-title mxw-560">
                            <div class="subtitle text-white wow fadeInUp" data-wow-delay=".3s">
                                <img src="{{ asset('assets/img/icon/arrowLeftWhite.svg') }}" alt="icon">
                                <span class="text-white">{{ $home['about_subtitle'] ?? 'about company' }}</span>
                                <img src="{{ asset('assets/img/icon/arrowRightWhite.svg') }}" alt="icon">
                            </div>
                            <h2 class="title text-white wow fadeInUp" data-wow-delay=".6s">{{ $home['about_title'] ?? 'Navigating Tech Horizons Together' }}</h2>
                            <p class="mt-25 text-white wow fadeInUp" data-wow-delay=".5s">{{ $home['about_text'] ?? '' }}</p>
                        </div>
                        <div class="fancy-box-wrapper style2">
                            <div class="fancy-box style2 wow fadeInUp" data-wow-delay=".3s">
                                <div class="item"><div class="icon"><img src="{{ asset('assets/img/icon/aboutIcon1_1.svg') }}" alt="icon"></div></div>
                                <div class="item"><h6>{{ $home['about_feature_1'] ?? 'Back-End Development' }}</h6></div>
                            </div>
                            <div class="fancy-box style2 wow fadeInUp" data-wow-delay=".5s">
                                <div class="item"><div class="icon"><img src="{{ asset('assets/img/icon/aboutIcon1_1.svg') }}" alt="icon"></div></div>
                                <div class="item"><h6>{{ $home['about_feature_2'] ?? 'Product Design' }}</h6></div>
                            </div>
                        </div>
                        <div class="counter-box-wrapper style1">
                            <div class="counter-box style1 wow fadeInUp" data-wow-delay=".3s">
                                <h3><span class="counter-number">{{ $home['about_stat_1_number'] ?? '20.5' }}</span> {{ $home['about_stat_1_suffix'] ?? 'k' }}</h3>
                                <h6>{{ $home['about_stat_1_label'] ?? 'Projects Done' }}</h6>
                            </div>
                            <div class="counter-box style1 wow fadeInUp" data-wow-delay=".5s">
                                <h3><span class="counter-number">{{ $home['about_stat_2_number'] ?? '100.5' }}</span> {{ $home['about_stat_2_suffix'] ?? 'k' }}</h3>
                                <h6>{{ $home['about_stat_2_label'] ?? 'Happy Clients' }}</h6>
                            </div>
                            <div class="counter-box style1 wow fadeInUp" data-wow-delay=".8s">
                                <h3><span class="counter-number">{{ $home['about_stat_3_number'] ?? '150.5' }}</span> {{ $home['about_stat_3_suffix'] ?? 'k' }}</h3>
                                <h6>{{ $home['about_stat_3_label'] ?? 'Team Members' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Projects --}}
<section class="project-section space fix">
    <div class="project-container-wrapper style1">
        <div class="container">
            <div class="section-title title-area mx-auto mb-10">
                <div class="subtitle d-flex justify-content-center">
                    <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                    <span>{{ $home['projects_subtitle'] ?? 'Examples of our work' }}</span>
                    <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                </div>
                <h2 class="title text-center">{{ $home['projects_title'] ?? 'Check Our Latest Portfolios' }}</h2>
            </div>
            <div class="project-item-wrapper style1">
                @foreach($projectCategories as $cat)
                    <div class="project-item-card style1 {{ $loop->index === 2 ? 'active' : '' }} wow fadeInUp" data-wow-delay=".{{ ($loop->index + 1) * 2 }}s">
                        <div class="project-icon">
                            <img src="{{ asset($cat['icon'] ?? 'assets/img/icon/projectItemIcon1_1.svg') }}" alt="icon">
                        </div>
                        <h5>{{ $cat['title'] ?? '' }}</h5>
                    </div>
                @endforeach
            </div>
            <div class="project-wrapper style1">
                <div class="row gy-5 gx-60">
                    <div class="col-xl-5">
                        <div class="project-thumb img-custom-anim-left wow fadeInUp" data-wow-delay=".5s">
                            <img src="{{ SiteSetting::mediaUrl($home['projects_image'] ?? null, 'assets/img/project/projectThumb1_1.png') }}" alt="thumb">
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="project-content-wrapper style1">
                            <div class="project-content style1">
                                <div class="row">
                                    <div class="col-xl-9">
                                        <div class="project-content-left">
                                            <h3>{{ $home['projects_detail_title'] ?? 'Detailing of our Project' }}</h3>
                                            <p class="text">{{ $home['projects_detail_text'] ?? '' }}</p>
                                            <div class="fancy-box-wrapper style3">
                                                <div class="fancy-box style3">
                                                    <div class="item"><div class="icon"><img src="{{ asset('assets/img/icon/projectIcon1_1.svg') }}" alt="icon"></div></div>
                                                    <div class="item"><h6>{{ $home['projects_feature_1'] ?? 'Responsive website' }}</h6></div>
                                                </div>
                                                <div class="fancy-box style3">
                                                    <div class="item"><div class="icon"><img src="{{ asset('assets/img/icon/projectIcon1_2.svg') }}" alt="icon"></div></div>
                                                    <div class="item"><h6>{{ $home['projects_feature_2'] ?? '100% Customers Satisfaction' }}</h6></div>
                                                </div>
                                            </div>
                                            <div class="fancy-box style3">
                                                <div class="item"><div class="icon"><img src="{{ asset('assets/img/icon/projectIcon1_3.svg') }}" alt="icon"></div></div>
                                                <div class="item"><h6>{{ $home['projects_feature_3'] ?? 'Big Data & Analytics' }}</h6></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <div class="project-content-right">
                                            <img class="img-custom-anim-right wow fadeInUp" data-wow-delay=".6s"
                                                 src="{{ SiteSetting::mediaUrl($home['projects_image_2'] ?? null, 'assets/img/project/projectThumb1_2.png') }}" alt="thumb">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="shape">
                                <a href="{{ route('projects.index') }}"><img class="rotate360" src="{{ asset('assets/img/shape/projectShape1_1.png') }}" alt="shape"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Video --}}
<div class="video-box-area wow fadeInUp" data-wow-delay="0.6s">
    <div class="video-wrap style1 img-custom-anim-left wow fadeInUp" data-wow-delay=".6s">
        <div class="container">
            <div class="video-box fix background-image"
                 data-bg-src="{{ SiteSetting::mediaUrl($home['video_image'] ?? null, 'assets/img/video/videoThumb1_1.png') }}">
                <a href="{{ $home['video_url'] ?? 'https://www.youtube.com/watch?v=f2Gzr8sAGB8' }}" class="play-btn popup-video">
                    <i class="fa-sharp fa-solid fa-play"></i>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Work process --}}
<section class="work-process-section space bg-theme-color2 fix">
    <div class="work-process-wrapper style1 space pb-0">
        <div class="container">
            <div class="row gy-5">
                @foreach($processSteps as $step)
                    <div class="col-xl-3">
                        <div class="work-process-card style1 {{ $loop->index === 1 ? 'active' : '' }} wow fadeInUp" data-wow-delay=".{{ ($loop->index + 1) * 2 }}s">
                            <div class="number">{{ $step['number'] ?? str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}</div>
                            <h3 class="title">{{ $step['title'] ?? '' }}</h3>
                            <p class="text">{{ $step['text'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@include('frontend.partials.home-pricing')

{{-- Team --}}
<section class="team-section fix">
    <div class="team-wrapper space style1" data-bg-src="{{ asset('assets/img/bg/teamBg1_1.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="section-title title-area mx-auto mb-45">
                        <div class="subtitle d-flex justify-content-center">
                            <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                            <span>{{ $home['team_subtitle'] ?? 'Our Expert' }}</span>
                            <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                        </div>
                        <h2 class="title text-center">{{ $home['team_title'] ?? 'See Our Skilled Expert Team' }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="slider-area">
                    <div class="swiper gt-slider teamSliderOne" id="teamSliderOne"
                         data-slider-options='{"loop": true, "breakpoints":{"0":{"slidesPerView":1,"centeredSlides":true},"576":{"slidesPerView":2,"centeredSlides":true},"768":{"slidesPerView":2},"992":{"slidesPerView":3},"1300":{"slidesPerView":4}}}'>
                        <div class="swiper-wrapper">
                            @php
                                $teamItems = ($team ?? collect())->take(8);
                                $fallbackTeam = [
                                    ['name' => 'Wade Warren', 'role' => 'Medical Assistant', 'img' => 'assets/img/team/teamThumb1_1.png'],
                                    ['name' => 'Masirul Islam', 'role' => 'Manager Assistant', 'img' => 'assets/img/team/teamThumb1_2.png'],
                                    ['name' => 'Jenny Wilson', 'role' => 'Web Designer', 'img' => 'assets/img/team/teamThumb1_3.png'],
                                    ['name' => 'Floyd Miles', 'role' => 'Head Assistant', 'img' => 'assets/img/team/teamThumb1_4.png'],
                                ];
                            @endphp
                            @forelse($teamItems as $member)
                                <div class="swiper-slide">
                                    <div class="team-card style1 img-custom-anim-left wow fadeInUp" data-wow-delay=".4s">
                                        <div class="team-card-thumb">
                                            <div class="shape1"><img src="{{ asset('assets/img/shape/teamCardShape1_1.png') }}" alt="shape"></div>
                                            <div class="shape2"><img src="{{ asset('assets/img/shape/teamCardShape1_2.png') }}" alt="shape"></div>
                                            <img class="thumbimg" src="{{ $member->imageUrl() ?: asset('assets/img/team/teamThumb1_1.png') }}" alt="{{ $member->name }}">
                                        </div>
                                        <div class="team-content">
                                            <h3><a href="{{ route('team.show', $member) }}">{{ $member->name }}</a></h3>
                                            <p>{{ $member->designation }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                @foreach($fallbackTeam as $member)
                                    <div class="swiper-slide">
                                        <div class="team-card style1">
                                            <div class="team-card-thumb">
                                                <div class="shape1"><img src="{{ asset('assets/img/shape/teamCardShape1_1.png') }}" alt="shape"></div>
                                                <div class="shape2"><img src="{{ asset('assets/img/shape/teamCardShape1_2.png') }}" alt="shape"></div>
                                                <img class="thumbimg" src="{{ asset($member['img']) }}" alt="{{ $member['name'] }}">
                                            </div>
                                            <div class="team-content">
                                                <h3><a href="{{ route('team.index') }}">{{ $member['name'] }}</a></h3>
                                                <p>{{ $member['role'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="faq-section space pb-0 fix">
    <div class="container">
        <div class="faq-wrapper style1">
            <div class="row gy-5">
                <div class="col-xl-6">
                    <div class="faq-thumb">
                        <img class="thumb1 img-custom-anim-top wow fadeInUp" data-wow-delay=".4s"
                             src="{{ SiteSetting::mediaUrl($home['faq_image'] ?? null, 'assets/img/faq/faqThumb1_1.png') }}" alt="thumb">
                        <div class="thumb2"><img src="{{ SiteSetting::mediaUrl($home['faq_image_2'] ?? null, 'assets/img/faq/faqThumb1_2.png') }}" alt="thumb"></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="section-title mxw-560">
                        <div class="subtitle">
                            <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                            <span>{{ $home['faq_subtitle'] ?? 'Faq' }}</span>
                            <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                        </div>
                        <h2 class="title">{{ $home['faq_title'] ?? "Prioritize Your Site’s Safety and Security" }}</h2>
                    </div>
                    <div class="faq-content style1">
                        <div class="faq-accordion">
                            <div class="accordion" id="accordionHome1">
                                @forelse(($faqs ?? collect()) as $faq)
                                    <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay=".{{ min(3 + $loop->index * 2, 9) }}s">
                                        <h5 class="accordion-header">
                                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#home1faq{{ $faq->id }}"
                                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                                {{ $faq->question }}
                                            </button>
                                        </h5>
                                        <div id="home1faq{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#accordionHome1">
                                            <div class="accordion-body">{!! nl2br(e($faq->answer)) !!}</div>
                                        </div>
                                    </div>
                                @empty
                                    @foreach([
                                        'Where should I incorporate my business?',
                                        'How long should a business plan be?',
                                        'What is included in your services?',
                                        'What type of company is measured?',
                                    ] as $i => $q)
                                        <div class="accordion-item mb-3">
                                            <h5 class="accordion-header">
                                                <button class="accordion-button {{ $i === 2 ? '' : 'collapsed' }}" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#home1fallback{{ $i }}">
                                                    {{ $q }}
                                                </button>
                                            </h5>
                                            <div id="home1fallback{{ $i }}" class="accordion-collapse collapse {{ $i === 2 ? 'show' : '' }}" data-bs-parent="#accordionHome1">
                                                <div class="accordion-body">
                                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't.
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA 1 --}}
<section class="cta-section space pb-0">
    <div class="container">
        <div class="cta-wrap style1 fix">
            <div class="shape"><img src="{{ asset('assets/img/shape/ctaShape1_1.png') }}" alt="shape"></div>
            <div class="row gy-5">
                <div class="col-xl-3">
                    <div class="cta-thumb img-custom-anim-left wow fadeInUp" data-wow-delay=".4s">
                        <img src="{{ SiteSetting::mediaUrl($home['cta_image'] ?? null, 'assets/img/cta/ctaThumb1_1.png') }}" alt="thumb">
                    </div>
                </div>
                <div class="col-xl-6 d-flex align-items-center">
                    <div class="section-title">
                        <div class="subtitle">
                            <img src="{{ asset('assets/img/icon/arrowLeftWhite.svg') }}" alt="icon">
                            <span class="text-white">{{ $home['cta_subtitle'] ?? 'Contact US' }}</span>
                            <img src="{{ asset('assets/img/icon/arrowRightWhite.svg') }}" alt="icon">
                        </div>
                        <h2 class="title">{{ $home['cta_title'] ?? '24/7 Expert Hosting Support Our Customers Love' }}</h2>
                    </div>
                </div>
                <div class="col-xl-3 d-flex align-items-center">
                    <div class="btn-wrapper">
                        <a class="gt-btn style5" href="{{ $home['cta_button_url'] ?? route('contact') }}">
                            {{ $home['cta_button_text'] ?? 'Talk to a Specialist' }}
                            <i class="fa-sharp fa-regular fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Testimonials --}}
<section class="testimonial-section space pb-0 fix wow fadeInUp" data-wow-delay=".5s"
         data-bg-src="{{ asset('assets/img/bg/testimonialBg1_1.png') }}">
    <div class="testimonial-wrap style3 space">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="section-title title-area mb-50 mx-auto">
                        <div class="subtitle d-flex justify-content-center">
                            <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                            <span>{{ $home['testimonial_subtitle'] ?? 'Testimonials' }}</span>
                            <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                        </div>
                        <h2 class="title text-center">{{ $home['testimonial_title'] ?? 'Our Latest Client Feedback' }}</h2>
                    </div>
                </div>
            </div>
            <div class="slider-area">
                <div class="swiper gt-slider testimonial-slider3" id="testimonialSlider3"
                     data-slider-options='{"loop": true,"centeredSlides":true, "breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":1},"768":{"slidesPerView":1},"992":{"slidesPerView":2},"1200":{"slidesPerView":3}}}'>
                    <div class="swiper-wrapper">
                        @forelse($testimonials as $item)
                            <div class="swiper-slide">
                                <div class="testimonial-card style3 img-custom-anim-left wow fadeInUp" data-wow-delay=".4s">
                                    <ul class="star-wrap">
                                        @for($s = 0; $s < 4; $s++)
                                            <li><img src="{{ asset('assets/img/icon/starIcon2.png') }}" alt="icon"></li>
                                        @endfor
                                        <li><img src="{{ asset('assets/img/icon/starIconRegular.png') }}" alt="icon"></li>
                                    </ul>
                                    <p class="text">"{{ $item['text'] ?? '' }}"</p>
                                    <div class="profile-box">
                                        <div class="testi-thumb">
                                            <img src="{{ asset($item['image'] ?? 'assets/img/testimonial/testiThumb3_1.png') }}" alt="thumb">
                                        </div>
                                        <div class="testi-content">
                                            <h3 class="title">{{ $item['name'] ?? '' }}</h3>
                                            <div class="designation">{{ $item['role'] ?? '' }}</div>
                                        </div>
                                    </div>
                                    <div class="quote">
                                        <img class="darkQuote" src="{{ asset('assets/img/icon/quoteIconDark.png') }}" alt="icon">
                                        <img class="whiteQuote" src="{{ asset('assets/img/icon/quoteIconWhite.png') }}" alt="icon">
                                    </div>
                                    <div class="shape3_1"><img src="{{ asset('assets/img/shape/testimonialShape3_1.png') }}" alt="shape"></div>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <div class="testimonial-card style3">
                                    <p class="text">Add testimonials from Site Settings → Home 1 Content.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="slider-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Blog --}}
<section class="blog-section space fix">
    <div class="blog-wrapper style1 space pt-0">
        <div class="container">
            <div class="title-wrap mb-45">
                <div class="section-title">
                    <div class="subtitle">
                        <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                        <span>{{ $home['blog_subtitle'] ?? 'Blog & News' }}</span>
                        <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                    </div>
                    <h2 class="title">{{ $home['blog_title'] ?? 'Featured News And Insights' }}</h2>
                </div>
                <div class="arrow-btn text-end wow fadeInUp" data-wow-delay=".9s">
                    <button data-slider-prev="#blogSliderOne" class="slider-arrow style1"><i class="fa-sharp fa-regular fa-arrow-left-long"></i></button>
                    <button data-slider-next="#blogSliderOne" class="slider-arrow style1 slider-next"><i class="fa-regular fa-arrow-right-long"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="slider-area blogSliderOne">
                    <div class="swiper gt-slider" id="blogSliderOne"
                         data-slider-options='{"loop": true, "breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":1,"centeredSlides":true},"768":{"slidesPerView":2},"992":{"slidesPerView":2},"1200":{"slidesPerView":3}}}'>
                        <div class="swiper-wrapper">
                            @forelse(($posts ?? collect()) as $post)
                                <div class="swiper-slide">
                                    <div class="blog-card style1 img-custom-anim-left wow fadeInUp" data-wow-delay=".4s">
                                        <div class="blog-card-thumb">
                                            <img src="{{ $post->imageUrl() ?: asset('assets/img/blog/blogThumb1_'.(($loop->index % 3) + 1).'.jpg') }}" alt="{{ $post->title }}">
                                        </div>
                                        <div class="blog-card-body">
                                            <div class="blog-meta">
                                                <div class="tag">{{ $post->category ?? 'Blog' }}</div>
                                                <div class="date">{{ optional($post->published_at)->format('F d, Y') ?: $post->created_at?->format('F d, Y') }}</div>
                                            </div>
                                            <h3><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h3>
                                            <div class="author-meta">
                                                <div class="fancy-box style1">
                                                    <div class="item"><img src="{{ asset('assets/img/blog/blogProfile1_'.(($loop->index % 3) + 1).'.png') }}" alt="thumb"></div>
                                                    <div class="item">
                                                        <h6>Admin</h6>
                                                        <p>Co, Founder</p>
                                                    </div>
                                                </div>
                                                <a class="link-btn style1" href="{{ route('blog.show', $post) }}"><i class="fa-solid fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                @foreach([1,2,3] as $i)
                                    <div class="swiper-slide">
                                        <div class="blog-card style1">
                                            <div class="blog-card-thumb">
                                                <img src="{{ asset('assets/img/blog/blogThumb1_'.$i.'.jpg') }}" alt="thumb">
                                            </div>
                                            <div class="blog-card-body">
                                                <div class="blog-meta">
                                                    <div class="tag">News</div>
                                                    <div class="date">MARCH 24, 2024</div>
                                                </div>
                                                <h3><a href="{{ route('blog.index') }}">Featured News And Insights</a></h3>
                                                <div class="author-meta">
                                                    <div class="fancy-box style1">
                                                        <div class="item"><img src="{{ asset('assets/img/blog/blogProfile1_'.$i.'.png') }}" alt="thumb"></div>
                                                        <div class="item"><h6>Admin</h6><p>Co, Founder</p></div>
                                                    </div>
                                                    <a class="link-btn style1" href="{{ route('blog.index') }}"><i class="fa-solid fa-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Bottom CTA --}}
<section class="cta-section space pb-0 mt-n150 mb-n116 z-5">
    <div class="container">
        <div class="cta-wrap style2">
            <div class="shape1_1 rotate360 d-none d-xl-block"><img src="{{ asset('assets/img/shape/ctaShape2_1.png') }}" alt="shape"></div>
            <div class="shape1_2 d-none d-xl-block"><img src="{{ asset('assets/img/shape/ctaShape2_2.png') }}" alt="shape"></div>
            <div class="shape1_3 d-none d-xl-block"><img src="{{ asset('assets/img/shape/ctaShape2_3.png') }}" alt="shape"></div>
            <div class="shape1_4 d-none d-xl-block"><img src="{{ asset('assets/img/shape/ctaShape2_4.png') }}" alt="shape"></div>
            <div class="cta-thumb d-none d-xl-block">
                <img src="{{ SiteSetting::mediaUrl($home['cta2_image'] ?? null, 'assets/img/cta/ctaThumb.png') }}" alt="thumb">
            </div>
            <h3 class="cta-title text-white wow fadeInUp" data-wow-delay=".3s">
                {{ $home['cta2_title'] ?? 'Stay Connected With Cutting Edge IT' }}
            </h3>
            <div class="btn-wrapper">
                <a class="gt-btn style5" href="{{ $home['cta2_button_url'] ?? route('contact') }}">
                    {{ $home['cta2_button_text'] ?? 'Talk to a Specialist' }}
                    <i class="fa-sharp fa-regular fa-arrow-right-long"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
