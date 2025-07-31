@extends('front.include.app')
@section('content')

    <div class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-btn">
                        <div class="btn-group">
                            <a href="{{ route('register') }}">Register yourself</a>
                            <a href="{{ route('login') }}">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="login-sec">
        <div class="container">
            <h2 class="mainHead">Client Have to provide information</h2>
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address:"
                                name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password:" name="password" required autocomplete="current-password">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="themeBtn">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="soccer">
        <div class="container">
            <div class="row" data-aos="fade-up" data-duration="4000">
                <div class="col-md-12">
                    <div class="start">
                        <h2>Start Winning With Expert Soccer Predictions</h2>
                        <p>Join thousands of members who have transformed their betting results with FutWin’s <br> premium analysis</p>
                        <div class="btn-group">
                            <a href="#">Join FutWin Today</a>
                            <a href="#">Join FutWin Today</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
