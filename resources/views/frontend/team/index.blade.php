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
                        @if($member->skillList())
                            <div class="mt-2" style="display:flex;flex-wrap:wrap;gap:6px;justify-content:center;">
                                @foreach($member->skillList() as $skill)
                                    <span style="background:var(--theme);color:#fff;font-size:12px;padding:4px 10px;border-radius:20px;">
                                        {{ $skill['name'] }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
