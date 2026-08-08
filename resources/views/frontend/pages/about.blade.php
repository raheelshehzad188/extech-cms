@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', ['title' => $page->title ?? 'About Us', 'banner_image' => $page->banner_image ?? null])
<section class="section-padding">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2>{{ $page->title ?? 'About Us' }}</h2>
                @if($page?->subtitle)<h5 style="color:var(--theme);">{{ $page->subtitle }}</h5>@endif
                <div class="mt-3">{!! $page->content ?? $settings->footer_about !!}</div>
            </div>
            <div class="col-lg-6">
                <img src="{{ $page?->banner_image ? asset('storage/'.$page->banner_image) : asset('assets/img/about/01.jpg') }}" alt="about" style="width:100%;border-radius:12px;">
            </div>
        </div>
        @if($team->count())
            <div class="row g-4 mt-5">
                @foreach($team as $member)
                    <div class="col-md-3 text-center">
                        <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" style="width:100%;border-radius:10px;">
                        <h5 class="mt-2">{{ $member->name }}</h5>
                        <p style="color:var(--theme);">{{ $member->designation }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
