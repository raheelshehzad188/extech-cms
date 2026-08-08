@extends('layouts.frontend')
@section('content')
@include('frontend.partials.breadcrumb', ['title' => $project->title, 'banner_image' => $project->banner_image])
<section class="section-padding">
    <div class="container">
        <img src="{{ $project->imageUrl() ?: asset('assets/img/project/01.jpg') }}" alt="{{ $project->title }}" style="width:100%;border-radius:12px;margin-bottom:24px;">
        <h2>{{ $project->title }}</h2>
        <p><strong>Client:</strong> {{ $project->client }} @if($project->category)| <strong>Category:</strong> {{ $project->category }}@endif</p>
        <div class="mt-3">{!! $project->description !!}</div>
    </div>
</section>
@endsection
