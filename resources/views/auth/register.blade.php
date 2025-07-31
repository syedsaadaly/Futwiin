@extends('front.include.app')
@section('content')
    <div class="inner-banner Register-banner">
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



    <section class="register-sec">
        <div class="container">
            <h2 class="mainHead">Client Have to provide information</h2>
            <form class="register-form" method="POST" action="{{ route('register') }}" >
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="First Name:"  name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Last Name:"  name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Middle Initial (if Any)">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address:" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Contact Number:">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password:" name="password" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password:"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="themeBtn">Register</button>
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
