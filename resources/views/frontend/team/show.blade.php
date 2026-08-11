@extends('layouts.frontend')

@section('content')
@php
    $skills = $member->skillList();
@endphp

@include('frontend.partials.breadcrumb', [
    'title' => $member->name,
    'banner_image' => $member->banner_image,
])

<section class="team-details-section fix section-padding">
    <div class="container">
        <div class="team-details-wrapper">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <div class="team-details-image">
                        <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="team-details-content">
                        <div class="details-info">
                            <h3>{{ $member->name }}</h3>
                            <span>{{ $member->designation }}</span>
                        </div>

                        @if($member->bio)
                            <p class="mt-3">{{ $member->bio }}</p>
                        @endif

                        @if($skills)
                            <div class="progress-area mt-4">
                                <div class="progress-wrap">
                                    @foreach($skills as $i => $skill)
                                        <div class="pro-items">
                                            <div class="pro-head">
                                                <h6 class="title">{{ $skill['name'] }}</h6>
                                                <span class="point">{{ $skill['percent'] }}%</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-value {{ $i % 2 === 1 ? 'style-two' : '' }}"
                                                    style="width: {{ $skill['percent'] }}%; animation: none;"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="social-icon">
                            <span>Social Media:</span>
                            @if($member->facebook)<a href="{{ $member->facebook }}"><i class="fa-brands fa-facebook-f"></i></a>@endif
                            @if($member->twitter)<a href="{{ $member->twitter }}" class="active"><i class="fa-brands fa-twitter"></i></a>@endif
                            @if($member->linkedin)<a href="{{ $member->linkedin }}"><i class="fa-brands fa-linkedin-in"></i></a>@endif
                            @if($member->instagram)<a href="{{ $member->instagram }}"><i class="fa-brands fa-instagram"></i></a>@endif
                        </div>
                    </div>
                </div>
            </div>

            @if($member->content)
                <div class="team-single-history pt-5">
                    <div class="title">
                        <h3>About {{ $member->name }}</h3>
                    </div>
                    <div class="mt-3">{!! $member->content !!}</div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
