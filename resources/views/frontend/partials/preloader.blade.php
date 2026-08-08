@php
    $letters = str_split($settings->preloader_text ?: 'EXTECH');
    $preloaderGif = $settings->preloaderGifUrl();
@endphp
<div id="preloader" class="preloader">
    <div class="animation-preloader">
        @if($preloaderGif)
            <div class="preloader-gif text-center mb-3">
                <img src="{{ $preloaderGif }}" alt="Loading" style="max-width:120px;height:auto;">
            </div>
        @else
            <div class="spinner"></div>
            <div class="txt-loading">
                @foreach($letters as $letter)
                    <span data-text-preloader="{{ $letter }}" class="letters-loading">{{ $letter }}</span>
                @endforeach
            </div>
        @endif
        <p class="text-center">{{ $settings->preloader_loading_text ?: 'Loading' }}</p>
    </div>
    <div class="loader">
        <div class="row">
            <div class="col-3 loader-section section-left"><div class="bg"></div></div>
            <div class="col-3 loader-section section-left"><div class="bg"></div></div>
            <div class="col-3 loader-section section-right"><div class="bg"></div></div>
            <div class="col-3 loader-section section-right"><div class="bg"></div></div>
        </div>
    </div>
</div>
<div class="mouse-cursor cursor-outer"></div>
<div class="mouse-cursor cursor-inner"></div>
