@extends('front.include.app')
@section('content')

    <div class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Expert Picks</h2>
                </div>
            </div>
        </div>
    </div>


   <section class="pick-sec Expert-pick">
        <div class="container">
            <div class="pick-top text-center" data-aos="fade-up" data-duration="4000">
                <h2 class="mainHead">Today's Featured Picks</h2>
                <p>Preview our expert predictions for today's matches. Full analysis and detailed picks are available for premium members.</p>
            </div>
            <div class="row justify-content-center" data-aos="fade-up" data-duration="4000">
                @forelse($predictions as $prediction)
                <div class="col-md-4">
                    <div class="pick-wrapp">
                        <figure class="pick-imag">
                            @if($prediction->getFirstMediaUrl('prediction_images'))
                            <img src="{{ $prediction->getFirstMediaUrl('prediction_images') }}" class="img-fluid" alt="{{ $prediction->team1->name }} vs {{ $prediction->team2->name }}">
                            @else
                            <img src="{{ asset('front/images/default-pick.webp') }}" class="img-fluid" alt="Default prediction image">
                            @endif
                        </figure>
                        <div class="pick-content">
                            <ul class="pick-list">
                                <li>
                                    <a href="">
                                        <span>{{ $prediction->league?->title ?? 'FIFA Club World Cup' }}</span>
                                        {{ $prediction->match_date->format('M d') }}, {{ \Carbon\Carbon::parse($prediction->match_time)->format('g:i A') }}
                                    </a>
                                </li>
                            </ul>
                            <h3>{{ $prediction->team1->name }} vs. {{ $prediction->team2->name }}</h3>
                            <div class="pick-center">
                                <div class="pick-main">
                                    <div class="pick-counter">
                                        <h5>{{ substr($prediction->team1->name, 0, 2) }}</h5>
                                        <span>{{ $prediction->team1->name }}</span>
                                    </div>
                                    <h6>vs</h6>
                                    <div class="pick-counter">
                                        <span>{{ $prediction->team2->name }}</span>
                                        <h5>{{ substr($prediction->team2->name, 0, 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <p>{{ Str::limit($prediction->text, 100) }}</p>
                            <div class="pick-bottom">
                                <a href="">82% Success Rate</a>
                                @if(auth()->check())
                                <a href="{{ route('prediction.view', $prediction->id) }}">Full Analysis<i class="fal fa-long-arrow-right"></i></a>
                                @else
                                <a href="{{ route('login') }}">Login for Analysis<i class="fal fa-long-arrow-right"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12 text-center">
                    <p>No featured predictions available at the moment.</p>
                </div>
                @endforelse

                @if($showRegisterButton)
                <div class="col-md-12 text-center">
                    <a href="{{ route('register') }}" class="themeBtn">Access All Premium Picks</a>
                </div>
                @endif
            </div>
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
