@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', ['title' => $post->title, 'banner_image' => $post->banner_image])
<section class="section-padding">
    <div class="container" style="max-width:860px;">
        @if($post->imageUrl())
            <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" style="width:100%;border-radius:12px;margin-bottom:24px;">
        @endif
        <h1>{{ $post->title }}</h1>
        <p style="color:var(--text);">{{ optional($post->published_at)->format('M d, Y') }} @if($post->author_name) · {{ $post->author_name }} @endif</p>
        <div class="mt-4">{!! $post->content !!}</div>
    </div>
</section>
@endsection
