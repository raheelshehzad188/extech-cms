@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', [
    'title' => $seo->breadcrumb_title ?? $seo->title ?? 'FAQs',
    'banner_image' => $seo->banner_image ?? null,
])
<section class="section-padding">
    <div class="container" style="max-width:900px;">
        <div class="accordion" id="faqAccordion">
            @foreach($faqs as $faq)
                <div class="accordion-item mb-3" style="border:1px solid var(--border);border-radius:10px;overflow:hidden;">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="faq{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">{{ $faq->answer }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
