@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', ['title' => $page->title, 'banner_image' => $page->banner_image])
<section class="section-padding">
    <div class="container">
        @if($page->banner_image)
            <img src="{{ asset('storage/'.$page->banner_image) }}" alt="{{ $page->title }}" style="width:100%;border-radius:12px;margin-bottom:24px;">
        @endif
        <h1>{{ $page->title }}</h1>
        @if($page->subtitle)<h5 style="color:var(--theme);">{{ $page->subtitle }}</h5>@endif
        <div class="mt-4">{!! $page->content !!}</div>
    </div>
</section>
@endsection
