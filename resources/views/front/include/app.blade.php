@include('front.include.header')

@include('front.include.menu')

    <div class="preLoader black">
        <img src="{{ asset('front/images/image.webp') }}" alt="img">
    </div>
    <div class="preLoader white"></div>
@yield('content')

@include('front.include.footer')
