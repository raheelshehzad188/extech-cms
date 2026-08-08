@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', ['title' => $service->title, 'banner_image' => $service->banner_image])
<section class="section-padding">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                @if($service->imageUrl())
                    <img src="{{ $service->imageUrl() }}" alt="{{ $service->title }}" style="width:100%;border-radius:12px;margin-bottom:24px;">
                @endif
                <h2>{{ $service->title }}</h2>
                @if($service->subtitle)<h5 style="color:var(--theme);">{{ $service->subtitle }}</h5>@endif
                <div class="content mt-3">{!! $service->description !!}</div>
                @if($service->features)
                    <ul class="mt-4">
                        @foreach($service->features as $feature)
                            <li>{{ is_array($feature) ? ($feature['feature'] ?? reset($feature)) : $feature }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-lg-4">
                <div style="background:var(--bg);padding:24px;border-radius:12px;">
                    <h4>All Services</h4>
                    <ul class="mt-3">
                        @foreach($services as $item)
                            <li style="margin-bottom:8px;">
                                <a href="{{ route('services.show', $item) }}" style="{{ $item->id === $service->id ? 'color:var(--theme);font-weight:700;' : '' }}">
                                    {{ $item->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
