<!-- MOUSE CURSOR -->
<div class="mouse-cursor cursor-outer"></div>
<div class="mouse-cursor cursor-inner"></div>
<header>
    <nav class="navbar navbar-expand-lg p-0">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ $global_settings['header_logo'] ?? asset('front/images/default.png') }}" class="img-fluid"
                    alt="{{ $global_settings['navbar_logo_alt'] ?? 'Logo' }}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fas fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('front.index') }}">Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.expert') }}">Expert Picks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.leagues') }}">Leagues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.testimonials') }}">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.pricing') }}">Pricing</a>
                    </li>
                </ul>
                @if (Auth::check())
                    @if (Auth::user()->hasRole('admin'))
                        <div class="form-inline">
                            <a href="{{ route('admin.dashboard') }}" class="themeBtn">Dashboard</a>
                        </div>
                    @elseif (Auth::user()->hasRole('user'))
                        <div class="form-inline">
                            <a href="{{ route('user.dashboard') }}" class="themeBtn">Dashboard</a>
                        </div>
                    @else
                        <div class="form-inline">
                            <a href="{{ route('logout') }}" class="themeBtn">Logout</a>
                        </div>
                    @endif
                @else
                    <div class="form-inline">
                        <a href="{{ route('login') }}" class="themeBtn">Login</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</header>
