@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', ['title' => 'Contact', 'banner_image' => $page->banner_image ?? null])
<section class="section-padding">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row g-5">
            <div class="col-lg-5">
                <h2>{{ $page->title ?? 'Get In Touch' }}</h2>
                <div class="mt-3">{!! $page->content ?? '' !!}</div>
                <ul class="mt-4" style="list-style:none;padding:0;">
                    @if($settings->address)<li class="mb-3"><i class="fal fa-map-marker-alt me-2" style="color:var(--theme);"></i>{{ $settings->address }}</li>@endif
                    @if($settings->email)<li class="mb-3"><i class="fal fa-envelope me-2" style="color:var(--theme);"></i>{{ $settings->email }}</li>@endif
                    @if($settings->phone)<li class="mb-3"><i class="far fa-phone me-2" style="color:var(--theme);"></i>{{ $settings->phone }}</li>@endif
                    @if($settings->working_hours)<li class="mb-3"><i class="fal fa-clock me-2" style="color:var(--theme);"></i>{{ $settings->working_hours }}</li>@endif
                </ul>
            </div>
            <div class="col-lg-7">
                <form method="POST" action="{{ route('contact.submit') }}" style="background:var(--bg);padding:28px;border-radius:12px;">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required>
                            @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-12">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject') }}">
                        </div>
                        <div class="col-12">
                            <textarea name="message" rows="5" class="form-control" placeholder="Message" required>{{ old('message') }}</textarea>
                            @error('message')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="gt-btn"><span>Send Message <i class="fa-solid fa-arrow-right-long"></i></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
