@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', [
    'title' => $product->title,
    'banner_image' => $product->banner_image ?? null,
])
<section class="service-details-section fix section-padding">
    <div class="container">
        <div class="service-details-wrapper">
            <div class="row g-4">
                <div class="col-12 col-lg-4 order-2 order-md-1">
                    <div class="main-sidebar">
                        <div class="single-sidebar-widget">
                            <div class="wid-title"><h3>Categories</h3></div>
                            <div class="widget-categories">
                                <ul>
                                    @foreach($categories as $category)
                                        <li class="{{ optional($product->category)->id === $category->id ? 'active' : '' }}">
                                            <a href="{{ route('marketplace.index', ['category' => $category->slug]) }}">
                                                {{ $category->name }} <i class="fa-solid fa-arrow-right-long"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="single-sidebar-widget">
                            <div class="wid-title"><h3>Product Price</h3></div>
                            <div class="opening-category">
                                <ul>
                                    <li>
                                        <strong style="font-size:28px;color:var(--theme);">{{ $product->displayPrice() }}</strong>
                                        @if($product->price_suffix)
                                            <span> {{ $product->price_suffix }}</span>
                                        @endif
                                    </li>
                                    @if($product->regularPrice())
                                        <li>Regular: <s>{{ $product->regularPrice() }}</s></li>
                                    @endif
                                    @if($product->sku)
                                        <li>SKU: {{ $product->sku }}</li>
                                    @endif
                                </ul>
                            </div>
                            <a href="{{ route('quote') }}" class="theme-btn mt-3" style="display:inline-block;">
                                Get A Quote <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div class="single-sidebar-image bg-cover" style="background-image: url('{{ asset('assets/img/service/post.jpg') }}');">
                            <div class="contact-text">
                                <div class="icon"><i class="fa-solid fa-phone"></i></div>
                                <h4>Need Help? Call Here</h4>
                                <h5>
                                    <a href="tel:{{ preg_replace('/\s+/', '', $settings->phone ?: '') }}">{{ $settings->phone ?: '+208-555-0112' }}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 order-1 order-md-2">
                    <div class="service-details-items">
                        <div class="details-image">
                            <img src="{{ $product->imageUrl() }}" alt="{{ $product->title }}">
                        </div>
                        <div class="details-content">
                            @if($product->category)
                                <span class="subtitle" style="color:var(--theme);">{{ $product->category->name }}</span>
                            @endif
                            <h3>{{ $product->title }}</h3>
                            @if($product->short_description)
                                <p class="mt-3">{{ $product->short_description }}</p>
                            @endif
                            <div class="mt-3 cms-page-content">{!! $product->description !!}</div>
                            @if($product->featureList())
                                <div class="details-video-items mt-4">
                                    <div class="content">
                                        <h4>What’s Included</h4>
                                        <ul class="list">
                                            @foreach($product->featureList() as $feature)
                                                <li><i class="fa-regular fa-circle-check"></i> {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @php $gallery = $product->gallery ?? []; @endphp
                            @if(count($gallery))
                                <div class="image-area mt-4">
                                    <div class="row g-4">
                                        @foreach($gallery as $image)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="thumb">
                                                    <img src="{{ $product->mediaUrl($image) }}" alt="{{ $product->title }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($related->count())
            <div class="section-title title-area mx-auto mt-5 mb-4">
                <h2 class="title text-center">Related Products</h2>
            </div>
            <div class="row g-4">
                @foreach($related as $item)
                    <div class="col-xl-3 col-md-6">
                        <div class="news-card-items style-2">
                            <div class="news-image">
                                <a href="{{ route('marketplace.show', $item) }}"><img src="{{ $item->imageUrl() }}" alt="{{ $item->title }}"></a>
                            </div>
                            <div class="news-content">
                                <h3><a href="{{ route('marketplace.show', $item) }}">{{ $item->title }}</a></h3>
                                <p>{{ $item->displayPrice() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
