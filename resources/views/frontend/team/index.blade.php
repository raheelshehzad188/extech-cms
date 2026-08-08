@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', ['title' => 'Our Team', 'banner_image' => null])
<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            @foreach($members as $member)
                <div class="col-xl-3 col-md-6">
                    <div style="background:var(--bg);padding:20px;border-radius:12px;text-align:center;">
                        <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" style="width:100%;border-radius:10px;margin-bottom:14px;">
                        <h4><a href="{{ route('team.show', $member) }}">{{ $member->name }}</a></h4>
                        <p style="color:var(--theme);">{{ $member->designation }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
