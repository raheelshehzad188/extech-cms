@php
    $isHome3 = ($settings->home_template ?? 'home-1') === 'home-3' && request()->routeIs('home');
@endphp
<header>
    @if($isHome3)
        <div class="header-top-section top-style-3">
            <div class="container">
                <div class="header-top-wrapper">
                    <ul class="contact-list">
                        @if($settings->email)
                            <li>
                                <i class="far fa-envelope"></i>
                                <a href="mailto:{{ $settings->email }}" class="link">{{ $settings->email }}</a>
                            </li>
                        @endif
                        @if($settings->phone)
                            <li>
                                <i class="fa-solid fa-phone-volume"></i>
                                <a href="tel:{{ preg_replace('/\s+/', '', $settings->phone) }}">{{ $settings->phone }}</a>
                            </li>
                        @endif
                    </ul>
                    <div class="top-right">
                        <div class="social-icon d-flex align-items-center">
                            <span>Follow Us:</span>
                            @if($settings->facebook)<a href="{{ $settings->facebook }}"><i class="fab fa-facebook-f"></i></a>@endif
                            @if($settings->twitter)<a href="{{ $settings->twitter }}"><i class="fab fa-twitter"></i></a>@endif
                            @if($settings->linkedin)<a href="{{ $settings->linkedin }}"><i class="fa-brands fa-linkedin-in"></i></a>@endif
                            @if($settings->youtube)<a href="{{ $settings->youtube }}"><i class="fa-brands fa-youtube"></i></a>@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div id="header-sticky" class="{{ $isHome3 ? 'header-3' : 'header-1' }}">
        @if($isHome3)
            <div class="plane-shape">
                <img src="{{ asset('assets/img/plane.png') }}" alt="shape-img">
            </div>
        @endif
        <div class="container">
            <div class="mega-menu-wrapper">
                <div class="header-main {{ $isHome3 ? '' : 'style-2' }}">
                    <div class="header-left">
                        <div class="logo">
                            <a href="{{ route('home') }}" class="header-logo">
                                <img src="{{ $settings->logoUrl() }}" alt="{{ $settings->site_name }}">
                            </a>
                        </div>
                    </div>
                    @if($isHome3)
                        <div class="header-right d-flex justify-content-end align-items-center">
                            <div class="mean__menu-wrapper">
                                <div class="main-menu">
                                    <nav id="mobile-menu">
                                        @include('frontend.partials.nav-items')
                                    </nav>
                                </div>
                            </div>
                            <div class="header-button">
                                <a href="{{ $settings->header_cta_url ?: route('contact') }}" class="theme-btn bg-white">
                                    <span>
                                        {{ $settings->header_cta_text ?: 'get A Quote' }}
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="header__hamburger d-lg-none my-auto">
                                <div class="sidebar__toggle"><i class="fas fa-bars"></i></div>
                            </div>
                        </div>
                    @else
                        <div class="header-middle">
                            <div class="mean__menu-wrapper">
                                <div class="main-menu">
                                    <nav id="mobile-menu">
                                        @include('frontend.partials.nav-items')
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="header-right d-flex justify-content-end align-items-center">
                            <div class="header-button ms-4">
                                <a href="{{ $settings->header_cta_url ?: route('contact') }}" class="gt-btn">
                                    <span>
                                        {{ $settings->header_cta_text ?: 'Get A Quote' }}
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="header__hamburger d-block d-xl-none my-auto">
                                <div class="sidebar__toggle"><i class="fas fa-bars"></i></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
