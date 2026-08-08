<header>
    <div id="header-sticky" class="header-1">
        <div class="container">
            <div class="mega-menu-wrapper">
                <div class="header-main style-2">
                    <div class="header-left">
                        <div class="logo">
                            <a href="{{ route('home') }}" class="header-logo">
                                <img src="{{ $settings->logoUrl() }}" alt="{{ $settings->site_name }}">
                            </a>
                        </div>
                    </div>
                    <div class="header-middle">
                        <div class="mean__menu-wrapper">
                            <div class="main-menu">
                                <nav id="mobile-menu">
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
                                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                                            <li><a href="{{ route('contact') }}">Contact</a></li>
                                        @endforelse
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="header-right d-flex justify-content-end align-items-center">
                        <div class="header-button ms-4">
                            <a href="{{ $settings->header_cta_url ?: route('contact') }}" class="gt-btn">
                                <span>
                                    {{ $settings->header_cta_text ?: 'Get A Quote' }}
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </span>
                            </a>
                        </div>
                        <div class="header__hamburger d-block d-xl-none my-auto">
                            <div class="sidebar__toggle"><i class="fas fa-bars"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
