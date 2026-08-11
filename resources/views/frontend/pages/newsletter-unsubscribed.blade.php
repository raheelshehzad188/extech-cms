@extends('layouts.frontend')

@section('content')
@include('frontend.partials.breadcrumb', [
    'title' => 'Newsletter',
    'subtitle' => 'Unsubscribed',
])

<section class="contact-section fix section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <h2>You have been unsubscribed</h2>
                <p class="mt-3">
                    <strong>{{ $subscriber->email }}</strong> will no longer receive newsletter emails from us.
                </p>
                <p class="mt-2">Changed your mind? You can subscribe again anytime from the website footer.</p>
                <a href="{{ route('home') }}" class="theme-btn mt-4">
                    Back to Home <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
