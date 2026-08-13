<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $seoModel = $seo ?? $settings;
        $pageTitle = method_exists($seoModel, 'seoTitle') ? $seoModel->seoTitle($settings->site_name) : ($settings->meta_title ?: $settings->site_name);
        $pageDescription = method_exists($seoModel, 'seoDescription') ? $seoModel->seoDescription($settings->meta_description) : ($settings->meta_description ?? '');
        $pageKeywords = method_exists($seoModel, 'seoKeywords') ? $seoModel->seoKeywords() : ($settings->meta_keywords ?? '');
        $ogImage = method_exists($seoModel, 'seoImage') ? $seoModel->seoImage() : null;
        if (!$ogImage && $settings->og_image) {
            $ogImage = asset('storage/'.$settings->og_image);
        }
    @endphp
    <title>{{ $pageTitle }}</title>
    <meta name="author" content="{{ $seoModel->meta_author ?? $settings->meta_author ?? $settings->site_name }}">
    <meta name="description" content="{{ $pageDescription }}">
    @if($pageKeywords)
        <meta name="keywords" content="{{ $pageKeywords }}">
    @endif
    <meta name="robots" content="{{ $seoModel->robots ?? $settings->robots ?? 'index, follow' }}">
    @if(!empty($seoModel->canonical_url) || !empty($settings->canonical_url))
        <link rel="canonical" href="{{ $seoModel->canonical_url ?? $settings->canonical_url }}">
    @else
        <link rel="canonical" href="{{ url()->current() }}">
    @endif

    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $seoModel->og_type ?? $settings->og_type ?? 'website' }}">
    <meta property="og:title" content="{{ $seoModel->og_title ?? $pageTitle }}">
    <meta property="og:description" content="{{ $seoModel->og_description ?? $pageDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($ogImage)
        <meta property="og:image" content="{{ $ogImage }}">
    @endif

    {{-- Twitter --}}
    <meta name="twitter:card" content="{{ $seoModel->twitter_card ?? $settings->twitter_card ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $seoModel->twitter_title ?? $pageTitle }}">
    <meta name="twitter:description" content="{{ $seoModel->twitter_description ?? $pageDescription }}">
    @if($seoModel->twitter_image ?? $ogImage)
        <meta name="twitter:image" content="{{ isset($seoModel->twitter_image) && $seoModel->twitter_image ? asset('storage/'.$seoModel->twitter_image) : $ogImage }}">
    @endif

    <link rel="shortcut icon" href="{{ $settings->faviconUrl() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{ $settings->googleFontsUrl() }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <style>
        @php
            $bodyTextColor = $settings->color_body ?: '#445375';
            $normalizedBody = strtolower(ltrim(trim((string) $bodyTextColor), '#'));
            // White/near-white body text on light pages looks "empty" — fall back to readable text color.
            if (in_array($normalizedBody, ['fff', 'ffffff', 'fefefe', 'fafafa', 'f8f8f8', 'f5f5f5'], true)) {
                $bodyTextColor = $settings->color_text ?: '#445375';
            }
        @endphp
        :root {
            --body: {{ $bodyTextColor }};
            --theme: {{ $settings->color_theme }};
            --theme2: {{ $settings->color_theme2 }};
            --theme-color3: {{ $settings->color_theme3 }};
            --header: {{ $settings->color_header }};
            --text: {{ $settings->color_text }};
            --border: {{ $settings->color_border }};
            --bg: {{ $settings->color_bg }};
            --bg2: {{ $settings->color_theme2 }};
            --title-color: {{ $settings->color_title }};
            --body-color: {{ $bodyTextColor }};
            --text-color: {{ $settings->color_text ?: '#445375' }};
            --smoke-color: {{ $settings->color_bg }};
            --title-font: "{{ $settings->font_title }}", sans-serif;
            --body-font: "{{ $settings->font_body }}", sans-serif;
        }
        body { font-family: var(--body-font); color: var(--body-color); }
        h1,h2,h3,h4,h5,h6 { font-family: var(--title-font); }

        .cms-page-content {
            color: var(--text-color, #445375);
            line-height: 1.75;
            font-size: 16px;
        }
        .cms-page-content p { margin-bottom: 1rem; }
        .cms-page-content h1,
        .cms-page-content h2,
        .cms-page-content h3,
        .cms-page-content h4,
        .cms-page-content h5,
        .cms-page-content h6 {
            color: var(--title-color, #0F0D1D);
            margin-bottom: .75rem;
        }
        .about-page-section > .container > .row > [class*="col-"] > h2 {
            color: var(--title-color, #0F0D1D);
        }


        /* Mobile header controls must stay clickable above decorative layers */
        .header-3 .header-main,
        .header-3 .header-right {
            position: relative;
            z-index: 20;
        }
        .header-3 .search-icon,
        .header-3 .header__hamburger,
        .header-3 .sidebar__toggle {
            position: relative;
            z-index: 30;
            pointer-events: auto !important;
            cursor: pointer;
        }
        .search-wrap {
            display: none;
        }
        @media (max-width: 991px) {
            .mean-container .mean-bar,
            .mean-container .mean-nav,
            a.meanmenu-reveal {
                display: none !important; /* custom offcanvas hamburger */
            }
            .header-3 .header__hamburger {
                display: block !important;
            }
        }

        .footer-locations {
            position: relative;
            overflow: hidden;
            padding: 40px 0 50px;
            border-top: 1px solid rgba(255,255,255,.12);
        }
        .footer-locations-head {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 48px;
            margin-bottom: 28px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }
        .footer-locations-title {
            position: relative;
            z-index: 1;
            margin: 0;
            color: #fff;
            font-family: var(--title-font);
            font-size: 24px;
            font-weight: 700;
            line-height: 1.2;
        }
        .footer-locations-watermark {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-55%);
            color: rgba(255,255,255,.08);
            font-family: var(--title-font);
            font-size: clamp(28px, 6vw, 64px);
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            white-space: nowrap;
            pointer-events: none;
            line-height: 1;
        }
        .footer-location-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }
        .footer-location-flag {
            flex: 0 0 48px;
            width: 48px;
            height: 32px;
            overflow: hidden;
            border-radius: 3px;
            box-shadow: 0 2px 8px rgba(0,0,0,.25);
        }
        .footer-location-flag img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .footer-location-info h4 {
            margin: 0 0 8px;
            color: #fff;
            font-family: var(--title-font);
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        .footer-location-info p,
        .footer-location-info a {
            margin: 0;
            color: rgba(255,255,255,.72);
            font-size: 14px;
            line-height: 1.7;
        }
        .footer-location-info a:hover {
            color: var(--theme);
        }

        .marketplace-filter .form-control,
        .marketplace-filter .form-select {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.18);
            color: #fff;
            min-height: 44px;
        }
        .marketplace-filter .form-control::placeholder {
            color: rgba(255,255,255,.55);
        }
        .marketplace-filter option {
            color: #111;
        }
        .marketplace-price-badge h3 {
            font-size: 18px !important;
            line-height: 1.15 !important;
        }
        .news-card-items .news-content p {
            color: var(--text-color, #445375);
            margin-top: 8px;
        }
    </style>

    @if(!empty($seoModel->schema_markup))
        <script type="application/ld+json">{!! $seoModel->schema_markup !!}</script>
    @elseif(!empty($settings->schema_markup))
        <script type="application/ld+json">{!! $settings->schema_markup !!}</script>
    @endif

    {!! $settings->custom_head_code !!}
    @stack('head')
</head>
<body>
    {!! $settings->custom_body_code !!}

    @include('frontend.partials.preloader')
    @include('frontend.partials.offcanvas')
    @include('frontend.partials.header')
    @include('frontend.partials.search')

    @yield('content')

    @include('frontend.partials.footer')

    @php
        $assetV = static function (string $path): string {
            $full = public_path($path);
            $ver = is_file($full) ? (string) filemtime($full) : (string) time();

            return asset($path).'?v='.$ver;
        };
    @endphp
    <script src="{{ $assetV('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script>
        // Prevent hard crashes if any cached script still calls owlCarousel.
        (function (jq) {
            if (jq && jq.fn && typeof jq.fn.owlCarousel !== 'function') {
                jq.fn.owlCarousel = function () { return this; };
            }
        })(window.jQuery);
    </script>
    <script src="{{ $assetV('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ $assetV('assets/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ $assetV('assets/js/jquery.waypoints.js') }}"></script>
    <script src="{{ $assetV('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ $assetV('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ $assetV('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ $assetV('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ $assetV('assets/js/wow.min.js') }}"></script>
    <script src="{{ $assetV('assets/js/viewport.jquery.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="{{ $assetV('assets/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
