@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', ['title' => 'Our Services', 'banner_image' => null])
<section class="service-section fix section-padding">
    <div class="container">
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-xl-4 col-md-6">
                    <div style="background:var(--bg);padding:28px;border-radius:12px;height:100%;">
                        @if($service->imageUrl())
                            <img src="{{ $service->imageUrl() }}" alt="{{ $service->title }}" style="width:100%;border-radius:8px;margin-bottom:16px;">
                        @endif
                        <h3><a href="{{ route('services.show', $service) }}">{{ $service->title }}</a></h3>
                        <p>{{ $service->short_description }}</p>
                        <a href="{{ route('quote', $service) }}" style="color:var(--theme);">Get A Quote →</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
