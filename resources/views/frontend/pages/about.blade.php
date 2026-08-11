@extends('layouts.frontend')
@section('content')
@php
    $aboutTitle = $page->title ?? 'About Us';
    $aboutSubtitle = $page->subtitle ?? null;
    $aboutContent = filled($page?->content)
        ? $page->content
        : ($settings->footer_about ?? '');
    $aboutImage = $page?->banner_image
        ? asset('storage/'.$page->banner_image)
        : asset('assets/img/about/01.jpg');
@endphp
@include('frontend.partials.breadcrumb', [
    'title' => $page->breadcrumb_title ?? $aboutTitle,
    'banner_image' => $page->banner_image ?? null,
])
<section class="about-page-section section-padding">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2>{{ $aboutTitle }}</h2>
                @if($aboutSubtitle)
                    <h5 style="color:var(--theme);">{{ $aboutSubtitle }}</h5>
                @endif
                <div class="cms-page-content mt-3">
                    @if(\Illuminate\Support\Str::contains((string) $aboutContent, ['<p', '<br', '<div', '<h', '<ul', '<ol', '<strong', '<em', '<span']))
                        {!! $aboutContent !!}
                    @else
                        {!! nl2br(e((string) $aboutContent)) !!}
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ $aboutImage }}" alt="{{ $aboutTitle }}" style="width:100%;border-radius:12px;">
            </div>
        </div>
        @if($team->count())
            <div class="row g-4 mt-5">
                @foreach($team as $member)
                    <div class="col-md-3 text-center">
                        <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" style="width:100%;border-radius:10px;">
                        <h5 class="mt-2" style="color:var(--title-color);">{{ $member->name }}</h5>
                        <p style="color:var(--theme);">{{ $member->designation }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
