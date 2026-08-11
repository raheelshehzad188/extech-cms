{{-- Offcanvas / Mobile Menu --}}
<div class="fix-area">
    <div class="offcanvas__info">
        <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
                <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                    <div class="offcanvas__logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ $settings->logoUrl() }}" alt="{{ $settings->site_name }}">
                        </a>
                    </div>
                    <div class="offcanvas__close">
                        <button type="button" aria-label="Close menu">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                @if($settings->offcanvas_text)
                    <p class="text d-none d-lg-block">{{ $settings->offcanvas_text }}</p>
                @endif

                <div class="mobile-menu fix mb-3"></div>

                <div class="offcanvas__contact">
                    <h4>Contact Info</h4>
                    <ul>
                        @if($settings->address)
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="#">{{ $settings->address }}</a>
                                </div>
                            </li>
                        @endif
                        @if($settings->email)
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                                </div>
                            </li>
                        @endif
                        @if($settings->working_hours)
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-clock"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="#">{{ $settings->working_hours }}</a>
                                </div>
                            </li>
                        @endif
                        @if($settings->phone)
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="far fa-phone"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="tel:{{ preg_replace('/\s+/', '', $settings->phone) }}">{{ $settings->phone }}</a>
                                </div>
                            </li>
                        @endif
                    </ul>

                    <div class="header-button mt-4">
                        <a href="{{ $settings->headerCtaUrl() }}" class="theme-btn text-center">
                            <span>
                                {{ $settings->header_cta_text ?: 'get A Quote' }}
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </span>
                        </a>
                    </div>

                    <div class="social-icon d-flex align-items-center">
                        @if($settings->facebook)<a href="{{ $settings->facebook }}"><i class="fab fa-facebook-f"></i></a>@endif
                        @if($settings->twitter)<a href="{{ $settings->twitter }}"><i class="fab fa-twitter"></i></a>@endif
                        @if($settings->youtube)<a href="{{ $settings->youtube }}"><i class="fab fa-youtube"></i></a>@endif
                        @if($settings->linkedin)<a href="{{ $settings->linkedin }}"><i class="fab fa-linkedin-in"></i></a>@endif
                        @if($settings->instagram)<a href="{{ $settings->instagram }}"><i class="fab fa-instagram"></i></a>@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas__overlay"></div>
