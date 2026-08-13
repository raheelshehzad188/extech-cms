<ul>
    @forelse($headerMenu as $item)
        <li class="{{ $item->children->count() ? 'has-dropdown' : '' }} {{ request()->url() === url($item->href()) ? 'active' : '' }}">
            <a href="{{ $item->href() }}">
                {{ $item->label }}
                @if($item->children->count())
                    <i class="fas fa-angle-down"></i>
                @endif
            </a>
            @if($item->children->count())
                <ul class="submenu">
                    @foreach($item->children as $child)
                        <li><a href="{{ $child->href() }}">{{ $child->label }}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
    @empty
        <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('about') }}">About</a></li>
        <li><a href="{{ route('services.index') }}">Services</a></li>
        <li><a href="{{ route('team.index') }}">Team</a></li>
        <li><a href="{{ route('projects.index') }}">Projects</a></li>
        <li><a href="{{ route('marketplace.index') }}">Marketplace</a></li>
        <li><a href="{{ route('blog.index') }}">Blog</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
    @endforelse
</ul>
