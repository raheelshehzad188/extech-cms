<div class="breadcrumb-wrapper bg-cover" style="background-image: url('{{ $banner ?? $settings->resolveBanner($banner_image ?? null) }}');">
    <div class="border-shape">
        <img src="{{ asset('assets/img/element.png') }}" alt="shape-img">
    </div>
    <div class="line-shape">
        <img src="{{ asset('assets/img/line-element.png') }}" alt="shape-img">
    </div>
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s">{{ $title }}</h1>
            <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <i class="fas fa-chevron-right"></i>
                </li>
                <li>
                    {{ $subtitle ?? $title }}
                </li>
            </ul>
        </div>
    </div>
</div>
