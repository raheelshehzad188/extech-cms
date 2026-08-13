@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', [
    'title' => $seo->breadcrumb_title ?? $seo->title ?? 'Marketplace',
    'banner_image' => $seo->banner_image ?? null,
])
<section class="service-section fix section-padding">
    <div class="container">
        <div class="section-title title-area mx-auto mb-20">
            <div class="subtitle d-flex justify-content-center">
                <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                <span>MARKETPLACE</span>
                <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
            </div>
            <h2 class="title text-center">{{ $seo->title ?? 'Our Digital Products' }}</h2>
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-4 order-2 order-lg-1">
                <div class="main-sidebar">
                    <div class="single-sidebar-widget">
                        <div class="wid-title"><h3>Filter</h3></div>
                        <form method="GET" action="{{ route('marketplace.index') }}" class="marketplace-filter">
                            <div class="mb-3">
                                <label class="d-block mb-2 text-white">Category</label>
                                <select name="category" class="form-select">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" @selected(optional($activeCategory)->id === $category->id)>
                                            {{ $category->name }} ({{ $category->products_count }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="d-block mb-2 text-white">Min Price</label>
                                    <input type="number" min="0" name="min_price" class="form-control" value="{{ $minPrice }}" placeholder="0">
                                </div>
                                <div class="col-6">
                                    <label class="d-block mb-2 text-white">Max Price</label>
                                    <input type="number" min="0" name="max_price" class="form-control" value="{{ $maxPrice }}" placeholder="500">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="d-block mb-2 text-white">Sort</label>
                                <select name="sort" class="form-select">
                                    <option value="latest" @selected($sort === 'latest')>Latest</option>
                                    <option value="price_low" @selected($sort === 'price_low')>Price: Low to High</option>
                                    <option value="price_high" @selected($sort === 'price_high')>Price: High to Low</option>
                                </select>
                            </div>
                            <button type="submit" class="theme-btn w-100">Apply Filter <i class="fa-solid fa-arrow-right-long"></i></button>
                            <a href="{{ route('marketplace.index') }}" class="theme-btn-2 d-block text-center mt-3">Reset</a>
                        </form>
                    </div>
                    <div class="single-sidebar-widget">
                        <div class="wid-title"><h3>Categories</h3></div>
                        <div class="widget-categories">
                            <ul>
                                <li class="{{ !$activeCategory ? 'active' : '' }}">
                                    <a href="{{ route('marketplace.index') }}">All Products <i class="fa-solid fa-arrow-right-long"></i></a>
                                </li>
                                @foreach($categories as $category)
                                    <li class="{{ optional($activeCategory)->id === $category->id ? 'active' : '' }}">
                                        <a href="{{ route('marketplace.index', ['category' => $category->slug]) }}">
                                            {{ $category->name }} <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 order-1 order-lg-2">
                <div class="row g-4">
                    @forelse($products as $product)
                        <div class="col-xl-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                            <div class="news-card-items style-2">
                                <div class="news-image">
                                    <a href="{{ route('marketplace.show', $product) }}">
                                        <img src="{{ $product->imageUrl() }}" alt="{{ $product->title }}">
                                    </a>
                                    <div class="post-date marketplace-price-badge">
                                        <h3>
                                            {{ $product->displayPrice() }}
                                            @if($product->price_suffix)
                                                <br><span>{{ $product->price_suffix }}</span>
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                                <div class="news-content">
                                    <ul>
                                        @if($product->category)
                                            <li><i class="fa-solid fa-tag"></i> {{ $product->category->name }}</li>
                                        @endif
                                        @if($product->regularPrice())
                                            <li><s>{{ $product->regularPrice() }}</s></li>
                                        @endif
                                    </ul>
                                    <h3><a href="{{ route('marketplace.show', $product) }}">{{ $product->title }}</a></h3>
                                    <p>{{ $product->short_description }}</p>
                                    <a href="{{ route('marketplace.show', $product) }}" class="theme-btn-2 mt-3">
                                        View Details <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-white">No products match your filters.</p>
                        </div>
                    @endforelse
                </div>
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
