@extends('front.include.app')
@section('style')
    <style>
        .live-badge {
            position: absolute;
            top: 10px;
            right: 25px;
            background-color: rgba(255, 255, 255, 0.9);
            color: #28a745;
            padding: 4px 8px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
            z-index: 10;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .live-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #28a745;
            margin-right: 6px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .live-text {
            font-size: 12px;
            font-weight: 600;
        }

        .time-with-status {
            position: relative;
            padding-right: 70px;
        }

        .live-status-modal {
            position: absolute;
            right: 140px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #28a745;
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .live-pulse-modal {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: white;
            margin-right: 6px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
@endsection
@section('content')

    <section class="main-banner">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-7">
                    <div class="slideOne">

                        {{-- Title + Highlight --}}
                        @if (!empty($banner->title))
                            <h1 data-swiper-parallax="-200">
                                {{ $banner->title }}
                                {!! !empty($banner->highlight) ? '<span>' . $banner->highlight . '</span>' : '' !!}
                            </h1>
                        @endif

                        {{-- Subtitle --}}
                        @if (!empty($banner->subtitle))
                            <p data-swiper-parallax="-200">{{ $banner->subtitle }}</p>
                        @endif

                        {{-- Buttons --}}
                        <div class="btn-group">
                            @foreach ([['text' => $banner->btn1_text ?? null, 'link' => $banner->btn1_link ?? '#'], ['text' => $banner->btn2_text ?? null, 'link' => $banner->btn2_link ?? '#']] as $btn)
                                @if (!empty($btn['text']))
                                    <a href="{{ $btn['link'] }}" class="themeBtn">{{ $btn['text'] }}</a>
                                @endif
                            @endforeach
                        </div>

                        {{-- Counters --}}
                        <div class="counter-main">
                            <div class="counters">
                                @php
                                    $counters = [
                                        [
                                            'value' => $banner->success_rate ?? 0,
                                            'suffix' => '%',
                                            'label' => 'Success Rate',
                                        ],
                                        [
                                            'value' => $banner->leagues ?? 0,
                                            'suffix' => '+',
                                            'label' => 'Leagues Covered',
                                        ],
                                        [
                                            'value' => $banner->members ?? 0,
                                            'suffix' => 'K+',
                                            'label' => 'Happy Members',
                                        ],
                                    ];
                                @endphp

                                @foreach ($counters as $counter)
                                    <div class="counter-box">
                                        <h2>
                                            <span class="counter"
                                                data-target="{{ $counter['value'] }}">0</span>{{ $counter['suffix'] }}
                                        </h2>
                                        <p>{{ $counter['label'] }}</p>
                                    </div>
                                @endforeach
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
                <h2 class="mainHead">{{ $picks->title ?? '' }}</h2>
                <p>{{ $picks->subtitle ?? '' }}</p>
            </div>
            <div class="row" data-aos="fade-up" data-duration="4000">
                @forelse($predictions as $prediction)
                    <div class="col-md-4">
                        <div class="pick-wrapp">
                            @if ($prediction->isLive())
                                <div class="live-badge">
                                    <span class="live-dot"></span>
                                    <span class="live-text">LIVE</span>
                                </div>
                            @endif
                            <figure class="pick-imag">
                                @if ($prediction->getFirstMediaUrl('prediction_images'))
                                    <img src="{{ $prediction->getFirstMediaUrl('prediction_images') }}" class="img-fluid"
                                        alt="{{ $prediction->title }}">
                                @else
                                    <img src="{{ asset('front/images/default-pick.webp') }}" class="img-fluid"
                                        alt="Default prediction image">
                                @endif
                            </figure>
                            <div class="pick-content">
                                <ul class="pick-list">
                                    <li>
                                        <a href="">
                                            <span>{{ $prediction->league?->title ?? 'FIFA Club World Cup' }}</span>
                                            {{ $prediction->match_date->format('M d') }},
                                            {{ \Carbon\Carbon::parse($prediction->match_time)->format('g:i A') }}
                                            ({{ $prediction->getTimezoneAbbreviation() }})
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
                                <p>{{ Str::limit($prediction->teaser_text, 100 ?? '-') }}</p>
                                <div class="pick-bottom">
                                    <a href="">82% Success Rate</a>
                                    @if (auth()->check())
                                        <a href="#" class="view-prediction"
                                            data-prediction-id="{{ $prediction->id }}">Full Analysis<i
                                                class="fal fa-long-arrow-right"></i></a>
                                    @else
                                        <a href="{{ route('login') }}">Login for Analysis<i
                                                class="fal fa-long-arrow-right"></i></a>
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

                @if ($predictions->count() > 0)
                    <div class="col-md-12 text-center">
                        @if (auth()->check())
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
                <h2 class="mainHead">{{ $players->title ?? '' }}</h2>
                <p>{{ $players->subtitle ?? '' }}</p>
            </div>
            <div class="row" data-aos="fade-up" data-duration="4000">
                <div class="col-md-12">
                    <div class="player-flex">
                        @foreach ($playersList as $player)
                            <div class="player-main">
                                <div class="player-wrapp">
                                    <figure class="player-imag">
                                        <img src="{{ $player->getFirstMediaUrl('featured-players') }}" class="img-fluid"
                                            alt="{{ $player->name }}">
                                    </figure>
                                    <ul class="player-list">
                                        <li><a href="">{{ $player->nationality }}</a></li>
                                        <li><a href="">{{ $player->position }}</a></li>
                                    </ul>
                                    <div class="player-content">
                                        <h2>{{ $player->name }}</h2>
                                        <p>{{ $player->club }}</p>
                                    </div>
                                </div>
                                <div class="player-bottom">
                                    <ul>
                                        <li><a href=""><span>Age</span>{{ $player->age }}</a></li>
                                    </ul>
                                    <h6>This Season<span>{{ $player->stats }}</span></h6>
                                    <p>{{ $player->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p>{{ $players->footer_text ?? 'Our expert analysts track these players\' performances to deliver winning predictions' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="icon-sec">
        <div class="container">
            <div class="icon-top" data-aos="fade-up" data-duration="4000">
                <h2 class="mainHead">{{ $howItWorks->title ?? 'How It Works' }}</h2>
                <p>{{ $howItWorks->subtitle ?? 'Our systematic approach to soccer betting analysis delivers consistent results for our members.' }}
                </p>
            </div>
            <div class="row" data-aos="fade-up" data-duration="4000">
                @foreach ($howItWorksItems as $item)
                    <div class="col-md-4">
                        <div class="icon-wrapp">
                            <a href="#"><i class="{{ $item->icon }}"></i></a>
                            <h4>{{ $item->title }}</h4>
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- <section class="member-sec">
        <div class="container">
            <div class="member-overlay" data-aos="fade-up" data-duration="4000">
                <div class="row align-items-center">
                    <div class="col-md-6" data-aos="fade-right" data-duration="4000">
                        <div class="member-content">
                            <h3>{{ $members->title ?? 'Why Our Members Win More' }}</h3>
                            <ul class="member-list">
                                @foreach ($memberPoints ?? [] as $point)
                                    <li>
                                        @if ($point->heading)
                                            <strong>{{ $point->heading }}:</strong>
                                        @endif
                                        {{ $point->text }}
                                        @if ($point->image)
                                            <img src="{{ $point->getFirstMediaUrl('image') }}"
                                                alt="{{ $point->heading ?? 'Point Image' }}" width="50">
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-left" data-duration="4000">
                        <figure class="member-img">
                            <img src="{{ $point->getFirstMediaUrl('members-section') }}"
                                alt="Members Section Image" class="img-fluid">
                        </figure>

                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="member-sec">
        <div class="container">
            <div class="member-overlay" data-aos="fade-up" data-duration="4000">
                <div class="row align-items-center">
                    <div class="col-md-6" data-aos="fade-right" data-duration="4000">
                        <div class="member-content">
                            <h3>{{ $decodedData['page_title'] ?? '' }}</h3>
                            <ul class="member-list">
                                @foreach ($memberPoints ?? [] as $point)
                                    <li>
                                        <i class="far fa-check-circle" style="color: #f6ae28;"></i>
                                        {{ $point->heading ?? '' }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-left" data-duration="4000">
                        <figure class="member-img">
                            <img src="{{ $members->getFirstMediaUrl('image') }}" alt="Members Section Image"
                                class="img-fluid">

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
                        <a class="nav-link active" id="domestic-tab" data-toggle="pill" href="#domestic"
                            role="tab">Domestic Leagues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="international-tab" data-toggle="pill" href="#international"
                            role="tab">International</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="mainTabContent">
                <div class="tab-pane fade show active" id="domestic" role="tabpanel">
                    <ul class="nav nav-tabs football-tabs justify-content-center" id="nestedTabDomestic" role="tablist">
                        @foreach ($domesticLeagues as $league)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab"
                                    href="#league-{{ $league->id }}" role="tab">
                                    {{ $league->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content pt-4" id="nestedTabContentDomestic">
                        @foreach ($domesticLeagues as $league)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="league-{{ $league->id }}" role="tabpanel">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <img src="{{ $league->getFirstMediaUrl('league_images') }}"
                                            class="img-fluid fotbal-img" alt="{{ $league->title }}">
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
                                            @if (Auth::check())
                                                <a href="{{ route('front.expert', ['id' => $league->id]) }}"
                                                    class="btn btn-success">Get {{ $league->title }} Picks</a>
                                            @else
                                                <a href="{{ route('register') }}" class="btn btn-success">Get
                                                    {{ $league->title }} Picks</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="international" role="tabpanel">
                    <ul class="nav nav-tabs football-tabs justify-content-center" id="nestedTabInternational"
                        role="tablist">
                        @foreach ($internationalLeagues as $league)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab"
                                    href="#league-{{ $league->id }}" role="tab">
                                    {{ $league->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content pt-4" id="nestedTabContentInternational">
                        @foreach ($internationalLeagues as $league)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="league-{{ $league->id }}" role="tabpanel">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <img src="{{ $league->getFirstMediaUrl('league_images') }}"
                                            class="img-fluid fotbal-img" alt="{{ $league->title }}">
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
                                            @if (Auth::check())
                                                <a href="{{ route('front.expert', ['id' => $league->id]) }}"
                                                    class="btn btn-success">Get {{ $league->title }} Picks</a>
                                            @else
                                                <a href="{{ route('register') }}" class="btn btn-success">Get
                                                    {{ $league->title }} Picks</a>
                                            @endif
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
                <h2 class="mainHead">{{ $twitterSection->title ?? 'Follow Us On Twitter' }}</h2>
                <p>{!! $twitterSection->description ??
                    'We share teasers of our premium picks on Twitter. Follow us to stay updated and get a taste of our expert analysis.' !!}</p>
            </div>
            <div class="row" data-aos="fade-up" data-duration="4000">
                @foreach ($twitterItems as $item)
                    <div class="col-md-4">
                        <div class="follow_us">
                            <div class="follow">
                                <figure>
                                    <i class="fab fa-twitter"></i>
                                </figure>
                                <div>
                                    <h4>{{ $item->username }}</h4>
                                    <p>{{ $item->handle }}</p>
                                </div>
                            </div>
                            <p class="big">{{ $item->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 text-center mt-3">
                <a href="{{ $twitterSection && $twitterSection->button_link ? $twitterSection->button_link : 'https://twitter.com/FutWin_Official' }}"
                    class="themeBtn" target="_blank">
                    {{ $twitterSection && $twitterSection->button_text ? $twitterSection->button_text : 'Follow Us on Twitter' }}
                </a>
            </div>


        </div>
    </section>

    <section class="saying">
        <div class="container">
            <div class="saying_head" data-aos="fade-up" data-duration="4000">
                <h2 class="mainHead">{{ $sayingCms->title ?? '' }}</h2>
                <p>{{ $sayingCms->subtitle ?? '' }}</p>
            </div>
            <div class="row" data-aos="fade-up" data-duration="4000">
                <div class="swiper testiSlide">
                    <div class="swiper-wrapper">
                        @foreach ($sayingList as $item)
                            <div class="swiper-slide">
                                <div class="testi_card">
                                    <ul>
                                        @for ($i = 0; $i < $item->rating; $i++)
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        @endfor
                                    </ul>
                                    <p>"{{ $item->message }}"</p>
                                    <div class="user_profile">
                                        <figure>
                                            <i class="fal fa-user"></i>
                                        </figure>
                                        <div>
                                            <h4>{{ $item->name }}</h4>
                                            <h5>{{ $item->designation }}</h5>
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




    <section class="success_stories">
        <div class="container" data-aos="fade-up" data-duration="4000">
            <div class="stories" data-aos="fade-up" data-duration="4000">
                <div class="success">
                    <h3>{{ $successStories->title ?? '' }}</h3>
                    <div class="row">
                        @foreach ($successStories->items ?? [] as $item)
                            <div class="col-md-3">
                                <div class="rating">
                                    <h3>{{ $item['value'] ?? '' }}</h3>
                                    <p>{{ $item['line1'] ?? '' }}</p>
                                    <p>{{ $item['line2'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
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
                        @foreach ($plans as $plan)
                            <div class="col-md-4 mb-4">
                                <div class="package">
                                    <h3>{{ $plan->name }}</h3>
                                    <div class="monthly">
                                        <h2>${{ number_format($plan->price, 2) }}</h2>
                                        @if (str_contains(strtolower($plan->name), 'monthly'))
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
                                            @if ($plan->points > 0)
                                                <li><i class="far fa-check-circle"></i> Earn {{ $plan->points }} points
                                                </li>
                                            @endif
                                            <li><i class="far fa-times-circle"></i> Email notifications</li>
                                            <li><i class="far fa-times-circle"></i> Early access to picks</li>
                                        </ul>
                                        <a
                                            href="{{ auth()->check() ? route('payment.show', $plan->id) : route('register', ['plan' => $plan->id]) }}">
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
                            <p>If our premium picks don't achieve at least a 70% success rate in your first month, we'll
                                extend your membership for free. We're confident in our analysis and want you to be too.</p>
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
                        <h2>{{ $global_settings['section_heading'] }}</h2>
                        <p>{{ $global_settings['section_paragraph'] }}</p>
                        <div class="btn-group">
                            <a
                                href="{{ $global_settings['section_btn_1_link'] }}">{{ $global_settings['section_btn_1_text'] }}</a>
                            <a
                                href="{{ $global_settings['section_btn_2_link'] }}">{{ $global_settings['section_btn_2_text'] }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="predictionModal" tabindex="-1" aria-labelledby="predictionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="predictionModalLabel">Prediction Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="predictionModalBody">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.view-prediction').click(function(e) {
                e.preventDefault();
                var predictionId = $(this).data('prediction-id');

                $('#predictionModal').modal('show');

                $.ajax({
                    url: "{{ route('prediction.view', '') }}/" + predictionId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('#predictionModalBody').html(response.html);
                        } else {
                            $('#predictionModalBody').html(
                                '<div class="alert alert-danger">' +
                                response.message +
                                (response.redirect ? '<br><a href="' + response.redirect +
                                    '" class="btn btn-primary mt-2">Subscribe Now</a>' : ''
                                ) +
                                '</div>'
                            );
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = 'An error occurred while loading the prediction.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $('#predictionModalBody').html(
                            '<div class="alert alert-danger">' + errorMessage + '</div>'
                        );
                    }
                });
            });
        });
    </script>
@endsection
