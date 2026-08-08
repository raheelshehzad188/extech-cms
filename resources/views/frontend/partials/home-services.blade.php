<section class="service-section fix section-padding">
    <div class="container">
        <div class="section-title title-area mx-auto text-center mb-50">
            <h6>{{ $home['services_subtitle'] ?? 'Our Services' }}</h6>
            <h2>{{ $home['services_title'] ?? 'We Provide Best IT Solutions' }}</h2>
            @if(!empty($home['services_text']))
                <p>{{ $home['services_text'] }}</p>
            @endif
        </div>
        <div class="row g-4">
            @forelse($services as $service)
                <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay=".{{ ($loop->index % 3 + 2) }}s">
                    <div class="service-card-items" style="background:var(--bg);padding:30px;border-radius:12px;height:100%;">
                        @if($service->imageUrl())
                            <div class="thumb mb-3">
                                <img src="{{ $service->imageUrl() }}" alt="{{ $service->title }}" style="width:100%;border-radius:8px;">
                            </div>
                        @elseif($service->icon)
                            <div class="icon mb-3" style="font-size:2rem;color:var(--theme);"><i class="{{ $service->icon }}"></i></div>
                        @endif
                        <h3><a href="{{ route('services.show', $service) }}">{{ $service->title }}</a></h3>
                        <p>{{ $service->short_description }}</p>
                        <a href="{{ route('services.show', $service) }}" class="link-btn" style="color:var(--theme);">
                            Read More <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center"><p>No services yet. Add them from admin.</p></div>
            @endforelse
        </div>
    </div>
</section>
