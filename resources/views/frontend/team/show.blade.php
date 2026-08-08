@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', ['title' => $member->name, 'banner_image' => $member->banner_image])
<section class="section-padding">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-4">
                <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" style="width:100%;border-radius:12px;">
            </div>
            <div class="col-lg-8">
                <h2>{{ $member->name }}</h2>
                <h5 style="color:var(--theme);">{{ $member->designation }}</h5>
                <p class="mt-3">{{ $member->bio }}</p>
                <div>{!! $member->content !!}</div>
                <div class="social-icon d-flex gap-3 mt-4">
                    @if($member->facebook)<a href="{{ $member->facebook }}"><i class="fab fa-facebook-f"></i></a>@endif
                    @if($member->twitter)<a href="{{ $member->twitter }}"><i class="fab fa-twitter"></i></a>@endif
                    @if($member->linkedin)<a href="{{ $member->linkedin }}"><i class="fab fa-linkedin-in"></i></a>@endif
                    @if($member->instagram)<a href="{{ $member->instagram }}"><i class="fab fa-instagram"></i></a>@endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
