@extends('front.include.app')
@section('content')

    <section class="main-banner">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-7">
                    <div class="slideOne">
                        <h1 data-swiper-parallax="-200">Expert Soccer Predictions That <span>Win</span></h1>
                        <p data-swiper-parallax="-200">
                            Get exclusive betting picks from Top 5 European leagues by experts with a proven track record of success </p>
                        <div class="btn-group">
                            <a href="{{ route('front.expert') }}" class="themeBtn">Start Winning Today</a>
                            <a href="{{ route('front.expert') }}" class="themeBtn">How It Works</a>
                        </div>
                        <div class="counter-main">
                            <div class="counters">
                                <div class="counter-box">
                                    <h2><span class="counter" data-target="92">0</span>%</h2>
                                    <p>Success Rate</p>
                                </div>
                                <div class="counter-box">
                                    <h2><span class="counter" data-target="5">0</span>+</h2>
                                    <p>Leagues Covered</p>
                                </div>
                                <div class="counter-box">
                                    <h2><span class="counter" data-target="10">0</span>K+</h2>
                                    <p>Happy Members</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pick-sec">
        <div class="container">
            <div class="pick-top" data-aos="fade-up" data-duration="4000">
                <h2 class="mainHead">Today's Featured Picks</h2>
                <p>Preview our expert predictions for today's matches. Full analysis and detailed picks are available for premium members.</p>
            </div>
            <div class="row" data-aos="fade-up" data-duration="4000">
                @forelse($predictions as $prediction)
                <div class="col-md-4">
                    <div class="pick-wrapp">
                        <figure class="pick-imag">
                            @if($prediction->getFirstMediaUrl('prediction_images'))
                            <img src="{{ $prediction->getFirstMediaUrl('prediction_images') }}" class="img-fluid" alt="{{ $prediction->title }}">
                            @else
                            <img src="{{ asset('front/images/default-pick.webp') }}" class="img-fluid" alt="Default prediction image">
                            @endif
                        </figure>
                        <div class="pick-content">
                            <ul class="pick-list">
                                <li>
                                    <a href="">
                                        <span>{{ $prediction->league->title ?? 'FIFA Club World Cup' }}</span>
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
                                <a href="{{ route('prediction.view', $prediction->uuid) }}">Full Analysis<i class="fal fa-long-arrow-right"></i></a>
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

                @if($predictions->count() > 0)
                <div class="col-md-12 text-center">
                    @if(auth()->check())
                    <a href="{{ route('front.expert') }}" class="themeBtn">View All Premium Picks</a>
                    @else
                    <a href="{{ route('register') }}" class="themeBtn">Access All Premium Picks</a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </section>

    <section class="player-sec">
        <div class="container">
            <div class="player-top" data-aos="fade-up" data-duration="4000">
                <h2 class="mainHead"> Featured Players</h2>
                <p> Get expert betting insights on matches featuring today's biggest football superstars</p>
            </div>
            <div class="row" data-aos="fade-up" data-duration="4000">
                <div class="col-md-12">
                    <div class="player-flex">
                        <div class="player-main">
                            <div class="player-wrapp">
                                <figure class="player-imag">
                                    <img src="{{ asset('front/images/player1.webp') }}" class="img-fluid" alt="">
                                </figure>
                                <ul class="player-list">
                                    <li><a href="">🇪🇸</a></li>
                                    <li><a href="">RW</a></li>
                                </ul>
                                <div class="player-content">
                                    <h2>
                                        Lamine Yamal</h2>
                                    <p> FC Barcelona</p>
                                </div>
                            </div>
                            <div class="player-bottom">
                                <ul>
                                    <li><a href=""><span>Age</span>17</a></li>
                                </ul>
                                <h6>This Season<span>15 Goals, 8 Assists</span></h6>
                                <p>Rising star breaking records at Barcelona</p>
                            </div>
                        </div>
                        <div class="player-main">
                            <div class="player-wrapp">
                                <figure class="player-imag">
                                    <img src="{{ asset('front/images/player2.webp') }}" class="img-fluid" alt="">
                                </figure>
                                <ul class="player-list">
                                    <li><a href="">RW</a></li>
                                    <li><a href="">
                                            🇪🇬</a></li>
                                </ul>
                                <div class="player-content">
                                    <h2>
                                        Mohamed Salah
                                    </h2>
                                    <p> Liverpool FC</p>
                                </div>
                            </div>
                            <div class="player-bottom">
                                <ul>
                                    <li><a href=""><span>Age</span>32</a></li>
                                </ul>
                                <h6>This Season<span> 22 Goals, 12 Assists</span></h6>
                                <p>Egyptian King dominating the Premier League</p>
                            </div>
                        </div>
                        <div class="player-main">
                            <div class="player-wrapp">
                                <figure class="player-imag">
                                    <img src="{{ asset('front/images/player3.webp') }}" class="img-fluid" alt="">
                                </figure>
                                <ul class="player-list">
                                    <li><a href="">
                                            ST</a></li>
                                    <li><a href="">🏴󠁧󠁢󠁥󠁮󠁧󠁿</a></li>
                                </ul>
                                <div class="player-content">
                                    <h2>
                                        Harry Kane </h2>
                                    <p> Bayern Munich</p>
                                </div>
                            </div>
                            <div class="player-bottom">
                                <ul>
                                    <li><a href=""><span>Age</span>31</a></li>
                                </ul>
                                <h6>This Season<span>28 Goals, 6 Assists </span></h6>
                                <p>England captain thriving in the Bundesliga</p>
                            </div>
                        </div>
                        <div class="player-main">
                            <div class="player-wrapp">
                                <figure class="player-imag">
                                    <img src="{{ asset('front/images/player4.webp') }}" class="img-fluid" alt="">
                                </figure>
                                <ul class="player-list">
                                    <li><a href="">ST</a></li>
                                    <li><a href="">🇦🇷</a></li>
                                </ul>
                                <div class="player-content">
                                    <h2>
                                        Lautaro Martínez </h2>
                                    <p>Inter Milan </p>
                                </div>
                            </div>
                            <div class="player-bottom">
                                <ul>
                                    <li><a href=""><span>Age</span>27</a></li>
                                </ul>
                                <h6>This Season<span>19 Goals, 4 Assists </span></h6>
                                <p>Argentine striker leading Inter’s
                                    attack</p>
                            </div>
                        </div>
                        <div class="player-main">
                            <div class="player-wrapp">
                                <figure class="player-imag">
                                    <img src="{{ asset('front/images/player7.webp') }}" class="img-fluid" alt="">
                                </figure>
                                <ul class="player-list">
                                    <li><a href="">RW</a></li>
                                    <li><a href="">🇫🇷</a></li>
                                </ul>
                                <div class="player-content">
                                    <h2>
                                        Ousmane Dembélé </h2>
                                    <p>Paris Saint-Germain </p>
                                </div>
                            </div>
                            <div class="player-bottom">
                                <ul>
                                    <li><a href=""><span>Age</span>17</a></li>
                                </ul>
                                <h6>This Season<span>12 Goals, 16 Assists </span></h6>
                                <p>French winger creating magic in
                                    Ligue 1</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Our expert analysts track these players' performances to deliver winning predictions</p>
                </div>
            </div>
        </div>
    </section>

    <section class="icon-sec">
        <div class="container">
            <div class="icon-top" data-aos="fade-up" data-duration="4000">
                <h2 class="mainHead"> How It Works</h2>
                <p> Our systematic approach to soccer betting analysis delivers consistent results for our members.</p>
            </div>
            <div class="row" data-aos="fade-up" data-duration="4000">
                <div class="col-md-4">
                    <div class="icon-wrapp">
                        <a href=""><i class="far fa-search"></i></a>
                        <h4>Expert Analysis</h4>
                        <p>Our team of professional analysts research team forms, injuries, and historical data to identify value bets.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="icon-wrapp">
                        <a href=""><i class="fas fa-vial"></i></a>
                        <h4>Exclusive Picks</h4>
                        <p>Members receive detailed predictions with reasoning and recommended stake levels before matches start.</p>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="icon-wrapp">
                        <a href=""><i class="fas fa-chart-line"></i></a>
                        <h4>Track Record</h4>
                        <p>We maintain transparent performance stats so you can see our historical success rates across leagues.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="member-sec">
        <div class="container">
            <div class="member-overlay" data-aos="fade-up" data-duration="4000">
                <div class="row align-items-center">
                    <div class="col-md-6" data-aos="fade-right" data-duration="4000">
                        <div class="member-content">
                            <h3>Why Our Members Win More</h3>
                            <ul class="member-list">
                                <li><a href=""><i class="far fa-check-circle"></i> In-depth analysis of team dynamics and tactical matchups</a></li>
                                <li><a href=""><i class="far fa-check-circle"></i> Focus on value bets with positive expected returns</a></li>
                                <li><a href=""><i class="far fa-check-circle"></i>Exclusive insights from industry insiders and former players</a></li>
                                <li><a href=""><i class="far fa-check-circle"></i>Disciplined staking strategy to maximize bankroll growth</a></li>
                                <li><a href=""><i class="far fa-check-circle"></i>Coverage across multiple leagues to find the best opportunities</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-left" data-duration="4000">
                        <figure class="member-img">
                            <img src="{{ asset('front/images/memberimg.webp') }}" class="img-fluid" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

 <section class="footerball-sec">
    <div class="container">
        <div class="container py-4 d-flex justify-content-center">
            <ul class="nav custom-tab-toggle" id="mainTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="domestic-tab" data-toggle="pill" href="#domestic" role="tab">Domestic Leagues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="international-tab" data-toggle="pill" href="#international" role="tab">International</a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="mainTabContent">
            <div class="tab-pane fade show active" id="domestic" role="tabpanel">
                <ul class="nav nav-tabs football-tabs justify-content-center" id="nestedTabDomestic" role="tablist">
                    @foreach($domesticLeagues as $league)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                           data-toggle="tab"
                           href="#league-{{ $league->id }}"
                           role="tab">
                           {{ $league->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>

                <div class="tab-content pt-4" id="nestedTabContentDomestic">
                    @foreach($domesticLeagues as $league)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="league-{{ $league->id }}" role="tabpanel">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <img src="{{ $league->getFirstMediaUrl('league_images') }}"
                                     class="img-fluid fotbal-img"
                                     alt="{{ $league->title }}">
                            </div>
                            <div class="col-md-5">
                                <div class="tab_content">
                                    <h4>{{ $league->title }}</h4>
                                    <p>{{ $league->text ?? 'No description available' }}</p>
                                    <ul class="list-unstyled">
                                        <li><i class="far fa-check-circle"></i> 20 teams coverage</li>
                                        <li><i class="far fa-check-circle"></i> 90% prediction accuracy</li>
                                        <li><i class="far fa-check-circle"></i> 380 matches per season</li>
                                    </ul>
                                    @guest
                                    <a href="{{ route('register') }}" class="btn btn-success">Get {{ $league->title }} Picks</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="international" role="tabpanel">
                <ul class="nav nav-tabs football-tabs justify-content-center" id="nestedTabInternational" role="tablist">
                    @foreach($internationalLeagues as $league)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                           data-toggle="tab"
                           href="#league-{{ $league->id }}"
                           role="tab">
                           {{ $league->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>

                <div class="tab-content pt-4" id="nestedTabContentInternational">
                    @foreach($internationalLeagues as $league)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="league-{{ $league->id }}" role="tabpanel">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <img src="{{ $league->getFirstMediaUrl('league_images') }}"
                                     class="img-fluid fotbal-img"
                                     alt="{{ $league->title }}">
                            </div>
                            <div class="col-md-5">
                                <div class="tab_content">
                                    <h4>{{ $league->title }}</h4>
                                    <p>{{ $league->text ?? 'No description available' }}</p>
                                    <ul class="list-unstyled">
                                        <li><i class="far fa-check-circle"></i> 20 teams coverage</li>
                                        <li><i class="far fa-check-circle"></i> 90% prediction accuracy</li>
                                        <li><i class="far fa-check-circle"></i> 380 matches per season</li>
                                    </ul>
                                    @guest
                                    <a href="{{ route('register') }}" class="btn btn-success">Get {{ $league->title }} Picks</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

    <section class="fifa">
        <div class="prediction-table" data-aos="fade-up" data-duration="4000">
            <h3>Recent FIFA Club World Cup Performance</h3>
            <table>
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>MATCH</th>
                        <th>PREDICTION</th>
                        <th>RESULT</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Jun 25</td>
                        <td><strong>Flamengo RJ vs Chelsea FC</strong></td>
                        <td>Chelsea Total Goals Under 2.5</td>
                        <td>Pending</td>
                        <td>Pending</td>
                    </tr>
                    <tr>
                        <td>Jun 26</td>
                        <td><strong>Bayern Munich vs Boca Juniors</strong></td>
                        <td>Boca Juniors Total Goals Under 1.5</td>
                        <td>Pending</td>
                        <td>Pending</td>
                    </tr>
                </tbody>
            </table>
            <div class="table-footer">
                <span>Showing Recent 2 Predictions</span>
                <a href="#">View Full History <i class="far fa-long-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <section class="twitter">
        <div class="container">
            <div class="twitter_head" data-aos="fade-up" data-duration="4000">
                <h2 class="mainHead">Follow Us On Twitter</h2>
                <p>We share teasers of our premium picks on Twitter. Follow us to stay updated and get a taste of <br>
                    our expert analysis.</p>
            </div>
            <div class="row" data-aos="fade-up" data-duration="4000">
                <div class="col-md-4">
                    <div class="follow_us">
                        <div class="follow">
                            <figure>
                                <i class="fab fa-twitter"></i>
                            </figure>
                            <div>
                                <h4>FutWin</h4>
                                <p>@FutWin_Official</p>
                            </div>
                        </div>
                        <p class="big">🔥 BIG match in the Premier League tonight! Our analysts have found excellent value in the Man City vs Arsenal showdown. Full analysis available for premium members. #EPL #Betting</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="follow_us">
                        <div class="follow">
                            <figure>
                                <i class="fab fa-twitter"></i>
                            </figure>
                            <div>
                                <h4>FutWin</h4>
                                <p>@FutWin_Official</p>
                            </div>
                        </div>
                        <p class="big">Another WINNING week for our members! 9 correct predictions out of 10 picks across the Top 5 European leagues. That's a 90% success rate! 🎯 #SoccerBetting #WinningPicks</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="follow_us">
                        <div class="follow">
                            <figure>
                                <i class="fab fa-twitter"></i>
                            </figure>
                            <div>
                                <h4>FutWin</h4>
                                <p>@FutWin_Official</p>
                            </div>
                        </div>
                        <p class="big">Bundesliga focus this weekend! Bayern vs Dortmund headlines our premium picks. We're seeing interesting patterns in the data that bookmakers haven't caught yet. 👀 #Bundesliga #ValueBets</p>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <a href="#" class="themeBtn">Follow Us on Twitter</a>
                </div>
            </div>
        </div>
    </section>

    <section class="saying">
        <div class="container">
            <div class="saying_head" data-aos="fade-up" data-duration="4000">
                <h2 class="mainHead">What Our Members Say</h2>
                <p>Join thousands of satisfied members who are winning more with our expert soccer predictions.</p>
            </div>
            <div class="row" data-aos="fade-up" data-duration="4000">
                <div class="swiper testiSlide">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testi_card">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                </ul>
                                <p>"I've been a member for 6 months and FutWin has completely transformed my betting. Their analysis is detailed and the picks are consistently profitable. Best investment I've made!"</p>
                                <div class="user_profile">
                                    <figure>
                                        <i class="fal fa-user"></i>
                                    </figure>
                                    <div>
                                        <h4> David Thompson</h4>
                                        <h5>Member since 2022</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testi_card">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                </ul>
                                <p>"What sets FutWin apart is their in-depth tactical analysis. They don't just tell you what to bet, they explain why, which has helped me develop my own betting strategy. Highly recommended!"</p>
                                <div class="user_profile">
                                    <figure>
                                        <i class="fal fa-user"></i>
                                    </figure>
                                    <div>
                                        <h4>Sarah Martinez</h4>
                                        <h5>Member since 2021</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testi_card">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                </ul>
                                <p>"The Premier League insights are exceptional. I've had an 82% success rate following their advice. The membership pays for itself many times over. The community is great too!"</p>
                                <div class="user_profile">
                                    <figure>
                                        <i class="fal fa-user"></i>
                                    </figure>
                                    <div>
                                        <h4> Michael Johnson</h4>
                                        <h5>Member since 2022</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="success_stories">
        <div class="container" data-aos="fade-up" data-duration="4000">
            <div class="stories" data-aos="fade-up" data-duration="4000">
                <div class="success">
                    <h3>Our Members' Success Stories</h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="rating">
                                <h3>10K+</h3>
                                <p>Active Members</p>
                                <p>Subscribers worldwide</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="rating">
                                <h3>85%</h3>
                                <p>Average Success Rate</p>
                                <p>Winning predictions</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="rating">
                                <h3>92%</h3>
                                <p>Renewal Rate</p>
                                <p>Member satisfaction</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="rating">
                                <h3>3.1x</h3>
                                <p>Average ROI</p>
                                <p>Return on investment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
             <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="satisfaction">
                        <figure>
                            <i class="fas fa-shield-alt"></i>
                        </figure>
                        <div>
                            <h2>Our Satisfaction Guarantee</h2>
                            <p>If our premium picks don't achieve at least a 70% success rate in your first month, we'll extend your membership for free. We're confident in our analysis and want you to be too.</p>
                        </div>

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
