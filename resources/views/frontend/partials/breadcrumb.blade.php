<section class="breadcrumb-wrapper bg-cover" style="background-image: url('{{ $banner ?? $settings->resolveBanner($banner_image ?? null) }}');">
    <div class="container">
        <div class="page-heading">
            <h1>{{ $title }}</h1>
            <ul class="breadcrumb-items">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li>{{ $subtitle ?? $title }}</li>
            </ul>
        </div>
    </div>
</section>
