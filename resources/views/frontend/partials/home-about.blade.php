<section class="about-section fix section-padding" style="background:var(--bg);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-content">
                    <h6 style="color:var(--theme);">{{ $home['about_subtitle'] ?? 'About Us' }}</h6>
                    <h2 style="margin:12px 0 18px;">{{ $home['about_title'] ?? 'We Make Your Business Smarter With Digital Solutions' }}</h2>
                    <p>{{ $home['about_text'] ?? ($settings->footer_about ?: 'We are a technology company focused on delivering high-quality IT services.') }}</p>
                    <a href="{{ $home['about_cta_url'] ?? route('about') }}" class="gt-btn mt-3">
                        <span>{{ $home['about_cta_text'] ?? 'Learn More' }} <i class="fa-solid fa-arrow-right-long"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                @if($projects->count())
                    <div class="row g-3">
                        @foreach($projects->take(2) as $project)
                            <div class="col-6">
                                <a href="{{ route('projects.show', $project) }}">
                                    <img src="{{ $project->imageUrl() ?: asset('assets/img/project/01.jpg') }}" alt="{{ $project->title }}" style="width:100%;border-radius:12px;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <img src="{{ asset('assets/img/about/01.jpg') }}" alt="about" style="width:100%;border-radius:12px;">
                @endif
            </div>
        </div>
    </div>
</section>
