@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', ['title' => 'Projects', 'banner_image' => null])
<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            @foreach($projects as $project)
                <div class="col-md-4">
                    <a href="{{ route('projects.show', $project) }}" style="display:block;background:var(--bg);border-radius:12px;overflow:hidden;">
                        <img src="{{ $project->imageUrl() ?: asset('assets/img/project/01.jpg') }}" alt="{{ $project->title }}" style="width:100%;">
                        <div style="padding:16px;">
                            <h4>{{ $project->title }}</h4>
                            <p>{{ $project->category }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
