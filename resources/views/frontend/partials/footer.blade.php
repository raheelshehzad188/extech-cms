@php
    $isHome = request()->routeIs('home');
    $footerSectionClass = $isHome ? 'footer-section pt-100 footer-bg' : 'footer-section pt-100 bg-theme-color2';
    $widgetAreaClass = $isHome ? 'widget-area style1 footer-bg pb-80' : 'widget-area style1 pb-80';
@endphp
<footer class="{{ $footerSectionClass }}">
    <div class="container">
        <div class="contact-info-area">
            <div class="contact-info-items wow fadeInUp" data-wow-delay=".3s">
                <div class="icon">
                    <i class="fal fa-map-marker-alt" style="font-size:28px;color:var(--theme);"></i>
                </div>
                <div class="content">
                    <p>Address</p>
                    <h3>{{ $settings->address ?: '4648 Rocky Road Philadelphia PA' }}</h3>
                </div>
            </div>
            <div class="contact-info-items wow fadeInUp" data-wow-delay=".5s">
                <div class="icon">
                    <i class="fal fa-envelope" style="font-size:28px;color:var(--theme);"></i>
                </div>
                <div class="content">
                    <p>Send Email</p>
                    <h3>
                        <a href="mailto:{{ $settings->email ?: 'info@example.com' }}">{{ $settings->email ?: 'info@example.com' }}</a>
                    </h3>
                </div>
            </div>
            <div class="contact-info-items wow fadeInUp" data-wow-delay=".7s">
                <div class="icon">
                    <i class="far fa-phone" style="font-size:28px;color:var(--theme);"></i>
                </div>
                <div class="content">
                    <p>Call Emergency</p>
                    <h3>
                        <a href="tel:{{ preg_replace('/\s+/', '', $settings->phone ?: '') }}">{{ $settings->phone ?: '+88 0123 654 99' }}</a>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="{{ $widgetAreaClass }}">
        <div class="container">
            <div class="footer-layout style1">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="widget footer-widget wow fadeInUp" data-wow-delay=".6s">
                            <div class="gt-widget-about">
                                <div class="about-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ $settings->logo_white ? asset('storage/'.$settings->logo_white) : asset('assets/img/footer-logo.svg') }}" alt="{{ $settings->site_name }}">
                                    </a>
                                </div>
                                <p class="about-text">
                                    {{ $settings->footer_about ?: 'Extech IT is a technology partner delivering reliable digital solutions for modern businesses.' }}
                                </p>
                                <div class="gt-social style2">
                                    @if($settings->facebook)<a href="{{ $settings->facebook }}"><i class="fab fa-facebook-f"></i></a>@endif
                                    @if($settings->twitter)<a href="{{ $settings->twitter }}"><i class="fab fa-twitter"></i></a>@endif
                                    @if($settings->youtube)<a href="{{ $settings->youtube }}"><i class="fab fa-youtube"></i></a>@endif
                                    @if($settings->instagram)<a href="{{ $settings->instagram }}"><i class="fab fa-instagram"></i></a>@endif
                                    @if($settings->linkedin)<a href="{{ $settings->linkedin }}"><i class="fab fa-linkedin-in"></i></a>@endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-6 col-12">
                        <div class="widget widget_nav_menu footer-widget wow fadeInUp" data-wow-delay="1s">
                            <h3 class="widget_title">Quick Links</h3>
                            <div class="menu-all-pages-container">
                                <ul class="menu">
                                    <li><a href="{{ route('about') }}"><i class="fa-solid fa-chevrons-right"></i>{{ $settings->site_name }} About</a></li>
                                    <li><a href="{{ route('services.index') }}"><i class="fa-solid fa-chevrons-right"></i>Our Services</a></li>
                                    <li><a href="{{ route('blog.index') }}"><i class="fa-solid fa-chevrons-right"></i>Our Blogs</a></li>
                                    <li><a href="{{ route('faq') }}"><i class="fa-solid fa-chevrons-right"></i>FAQ’S</a></li>
                                    <li><a href="{{ route('contact') }}"><i class="fa-solid fa-chevrons-right"></i>Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="widget footer-widget wow fadeInUp" data-wow-delay="1.3s">
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">
                                @php
                                    $footerPosts = \App\Models\Post::query()
                                        ->where('is_published', true)
                                        ->orderByDesc('published_at')
                                        ->take(2)
                                        ->get();
                                @endphp
                                @forelse($footerPosts as $post)
                                    <div class="recent-post">
                                        <div class="media-img">
                                            <a href="{{ route('blog.show', $post) }}">
                                                <img src="{{ $post->imageUrl() ?: asset('assets/img/footer/footerThumb1_'.($loop->iteration).'.png') }}" alt="{{ $post->title }}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="recent-post-meta">
                                                <a href="{{ route('blog.show', $post) }}">
                                                    <img src="{{ asset('assets/img/icon/calendarIcon.svg') }}" alt="icon">
                                                    {{ optional($post->published_at)->format('jS F, Y') ?: now()->format('jS F, Y') }}
                                                </a>
                                            </div>
                                            <h4 class="post-title">
                                                <a class="text-inherit" href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @empty
                                    <div class="recent-post">
                                        <div class="media-img">
                                            <a href="{{ route('blog.index') }}"><img src="{{ asset('assets/img/footer/footerThumb1_1.png') }}" alt="thumb"></a>
                                        </div>
                                        <div class="media-body">
                                            <div class="recent-post-meta">
                                                <a href="{{ route('blog.index') }}"><img src="{{ asset('assets/img/icon/calendarIcon.svg') }}" alt="icon">15th April, 2024</a>
                                            </div>
                                            <h4 class="post-title"><a class="text-inherit" href="{{ route('blog.index') }}">Top 5 Most Famous Technology Trend In 2024</a></h4>
                                        </div>
                                    </div>
                                    <div class="recent-post">
                                        <div class="media-img">
                                            <a href="{{ route('blog.index') }}"><img src="{{ asset('assets/img/footer/footerThumb1_2.png') }}" alt="thumb"></a>
                                        </div>
                                        <div class="media-body">
                                            <div class="recent-post-meta">
                                                <a href="{{ route('blog.index') }}"><img src="{{ asset('assets/img/icon/calendarIcon.svg') }}" alt="icon">20th June, 2024</a>
                                            </div>
                                            <h4 class="post-title"><a class="text-inherit" href="{{ route('blog.index') }}">The Surfing Man Will Blow Your Mind</a></h4>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="widget widget_nav_menu footer-widget wow fadeInUp" data-wow-delay="1.6s" id="newsletter">
                            <h3 class="widget_title">Contact Us</h3>
                            <div class="checklist style2">
                                <ul class="ps-0">
                                    <li class="text-white"><i class="fa-solid fa-envelope"></i></li>
                                    <li class="text-white">{{ $settings->email ?: 'info@example.com' }}</li>
                                </ul>
                                <ul class="ps-0">
                                    <li class="text-white"><i class="fa-solid fa-phone"></i></li>
                                    <li class="text-white">{{ $settings->phone ?: '+208-6666-0112' }}</li>
                                </ul>

                                @if(session('newsletter_success'))
                                    <div class="alert alert-success py-2 px-3 mb-2" style="font-size:14px;">
                                        {{ session('newsletter_success') }}
                                    </div>
                                @endif
                                @if(session('newsletter_error'))
                                    <div class="alert alert-danger py-2 px-3 mb-2" style="font-size:14px;">
                                        {{ session('newsletter_error') }}
                                    </div>
                                @endif
                                <div id="newsletter-message" class="mb-2" style="display:none;font-size:14px;"></div>

                                <form action="{{ route('newsletter.subscribe') }}" method="POST" id="newsletterForm" novalidate>
                                    @csrf
                                    <input type="hidden" name="source" value="footer">
                                    <div class="email-input-container">
                                        <input type="email" name="email" id="newsletterEmail" placeholder="Your email address" value="{{ old('email') }}" required autocomplete="email">
                                        <button type="submit" id="submitButton" disabled aria-label="Subscribe to newsletter">
                                            <i class="fa-regular fa-arrow-right-long"></i>
                                        </button>
                                    </div>
                                    <label class="custom-checkbox mt-2">
                                        <input type="checkbox" name="agree" id="agreeCheckbox" value="1" {{ old('agree') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                        I agree to the <a class="text-underline" href="{{ route('contact') }}" target="_blank">Privacy Policy.</a>
                                    </label>
                                    @error('email')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                    @error('agree')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-wrap bg-theme">
        <div class="container">
            <div class="copyright-layout">
                <div class="layout-text wow fadeInUp" data-wow-delay=".3s">
                    <p class="copyright">
                        <i class="fal fa-copyright"></i>
                        {{ $settings->footer_copyright ?: ('All Copyright '.date('Y').' by '.$settings->site_name) }}
                    </p>
                </div>
                <div class="layout-link wow fadeInUp" data-wow-delay=".6s">
                    <div class="link-wrapper">
                        <a href="{{ route('contact') }}">Terms &amp; Condition</a>
                        <a href="{{ route('contact') }}">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
