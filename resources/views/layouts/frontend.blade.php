<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        :root {
            --body: {{ $settings->color_body }};
            --theme: {{ $settings->color_theme }};
            --theme2: {{ $settings->color_theme2 }};
            --theme-color3: {{ $settings->color_theme3 }};
            --header: {{ $settings->color_header }};
            --text: {{ $settings->color_text }};
            --border: {{ $settings->color_border }};
            --bg: {{ $settings->color_bg }};
            --bg2: {{ $settings->color_theme2 }};
            --title-color: {{ $settings->color_title }};
            --body-color: {{ $settings->color_body }};
            --smoke-color: {{ $settings->color_bg }};
            --title-font: "{{ $settings->font_title }}", sans-serif;
            --body-font: "{{ $settings->font_body }}", sans-serif;
        }
        body { font-family: var(--body-font); }
        h1,h2,h3,h4,h5,h6 { font-family: var(--title-font); }
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
    @include('frontend.partials.header')

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
    <script src="{{ $assetV('assets/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
