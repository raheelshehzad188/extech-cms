<footer class="footer-section footer-bg">
    <div class="container">
        <div class="footer-widgets-wrapper">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <a href="{{ route('home') }}">
                                <img src="{{ $settings->logo_white ? asset('storage/'.$settings->logo_white) : $settings->logoUrl() }}" alt="{{ $settings->site_name }}">
                            </a>
                        </div>
                        <div class="footer-content">
                            <p>{{ $settings->footer_about ?: $settings->tagline }}</p>
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
                <div class="col-xl-2 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="single-footer-widget">
                        <div class="widget-head"><h3>Quick Links</h3></div>
                        <ul class="list-area">
                            <li><a href="{{ route('about') }}"><i class="fa-solid fa-chevron-right"></i> About Us</a></li>
                            <li><a href="{{ route('services.index') }}"><i class="fa-solid fa-chevron-right"></i> Services</a></li>
                            <li><a href="{{ route('team.index') }}"><i class="fa-solid fa-chevron-right"></i> Team</a></li>
                            <li><a href="{{ route('contact') }}"><i class="fa-solid fa-chevron-right"></i> Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                    <div class="single-footer-widget">
                        <div class="widget-head"><h3>Contact</h3></div>
                        <ul class="contact-list">
                            @if($settings->address)
                                <li>
                                    <i class="fal fa-map-marker-alt"></i>
                                    <a href="#">{{ $settings->address }}</a>
                                </li>
                            @endif
                            @if($settings->email)
                                <li>
                                    <i class="fal fa-envelope"></i>
                                    <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                                </li>
                            @endif
                            @if($settings->phone)
                                <li>
                                    <i class="far fa-phone"></i>
                                    <a href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                    <div class="single-footer-widget">
                        <div class="widget-head"><h3>Hours</h3></div>
                        <p>{{ $settings->working_hours ?: 'Mon - Fri, 09am - 05pm' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-wrapper d-flex align-items-center justify-content-between">
                <p class="wow fadeInLeft" data-wow-delay=".3s">
                    {{ $settings->footer_copyright ?: ('© '.date('Y').' '.$settings->site_name.'. All Rights Reserved.') }}
                </p>
            </div>
        </div>
    </div>
</footer>
