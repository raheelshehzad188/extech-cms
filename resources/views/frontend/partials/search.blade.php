{{-- Search Popup --}}
<div class="search-wrap">
    <div class="search-inner">
        <i class="fas fa-times search-close" id="search-close"></i>
        <div class="search-cell">
            <form method="get" action="{{ route('blog.index') }}">
                <div class="search-field-holder">
                    <input type="search" name="q" class="main-search-input" placeholder="Search...">
                </div>
            </form>
        </div>
    </div>
</div>
