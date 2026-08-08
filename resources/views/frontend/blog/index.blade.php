@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', ['title' => 'Blog', 'banner_image' => null])
<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            @foreach($posts as $post)
                <div class="col-md-4">
                    <article style="background:var(--bg);border-radius:12px;overflow:hidden;height:100%;">
                        @if($post->imageUrl())
                            <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" style="width:100%;">
                        @endif
                        <div style="padding:18px;">
                            <h4><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h4>
                            <p>{{ $post->excerpt }}</p>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $posts->links() }}</div>
    </div>
</section>
@endsection
