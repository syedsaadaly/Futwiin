@extends('front.include.app')
@section('content')



    <div class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Pricing</h2>
                </div>
            </div>
        </div>
    </div>



   <section class="membership pricing-membership">
        <div class="container">
            <div class="member_head" data-aos="fade-up" data-duration="4000">
                <h2 class="mainHead">Membership Plans</h2>
                <p>Choose the plan that fits your needs and start winning with our expert soccer predictions.</p>
            </div>
            <div class="row justify-content-center" data-aos="fade-up" data-duration="4000">
                <div class="col-md-10">
                    <div class="row align-items-end justify-content-center">
                        @foreach($plans as $plan)
                        <div class="col-md-4 mb-4">
                            <div class="package">
                                <h3>{{ $plan->name }}</h3>
                                <div class="monthly">
                                    <h2>${{ number_format($plan->price, 2) }}</h2>
                                    @if(str_contains(strtolower($plan->name), 'monthly'))
                                        <h5>per month</h5>
                                    @elseif(str_contains(strtolower($plan->name), 'quarterly'))
                                        <h5>per quarter</h5>
                                        <h4>Save 20%</h4>
                                    @elseif(str_contains(strtolower($plan->name), 'annual'))
                                        <h5>per year</h5>
                                        <h4>Save 20%</h4>
                                    @endif
                                    <ul>
                                        <li><i class="far fa-check-circle"></i> All premium picks</li>
                                        <li><i class="far fa-check-circle"></i> Detailed analysis</li>
                                        <li><i class="far fa-check-circle"></i> Top 5 leagues coverage</li>
                                        @if($plan->points > 0)
                                            <li><i class="far fa-check-circle"></i> Earn {{ $plan->points }} points</li>
                                        @endif
                                        <li><i class="far fa-times-circle"></i> Email notifications</li>
                                        <li><i class="far fa-times-circle"></i> Early access to picks</li>
                                    </ul>
                                    <a href="{{ auth()->check() ? route('payment.show', $plan->uuid) : route('register', ['plan' => $plan->uuid]) }}">
                                        Sign Up & Subscribe
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
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
