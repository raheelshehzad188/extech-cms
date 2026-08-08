@php $letters = str_split($settings->preloader_text ?: 'EXTECH'); @endphp
<div id="preloader" class="preloader">
    <div class="animation-preloader">
        <div class="spinner"></div>
        <div class="txt-loading">
            @foreach($letters as $letter)
                <span data-text-preloader="{{ $letter }}" class="letters-loading">{{ $letter }}</span>
            @endforeach
        </div>
        <p class="text-center">Loading</p>
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
