@extends('front.include.app')
@section('content')



    <div class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Leagues</h2>
                </div>
            </div>
        </div>
    </div>


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

    <section class="fifa leagues-fifa">
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

@section('scripts')
<script>
$(document).ready(function() {
    $('.international-league').hide();
    $('.tab-content.international').hide();

    if ($('.domestic-league').length === 0) {
        $('.league-type-selector a[data-type="international"]').click();
    }

    $('.league-type-selector a').click(function(e) {
        e.preventDefault();
        var type = $(this).data('type');

        $('.league-type-selector a').removeClass('active');
        $(this).addClass('active');

        if (type === 'domestic') {
            $('.domestic-league').show();
            $('.international-league').hide();

            if ($('.tab-content.active').length === 0 || $('.tab-content.active').hasClass('international')) {
                $('.tab-content.active').removeClass('active').hide();
                $('.domestic-league:first a').click();
            }
        } else {
            $('.domestic-league').hide();
            $('.international-league').show();

            if ($('.tab-content.active').length === 0 || $('.tab-content.active').hasClass('domestic')) {
                $('.tab-content.active').removeClass('active').hide();
                $('.international-league:first a').click();
            }
        }
    });

    $('#tabs-nav').on('click', 'li a', function(e) {
        e.preventDefault();
        var tabId = $(this).attr('href');

        $('#tabs-nav li').removeClass('active');
        $(this).parent().addClass('active');

        $('.tab-content').removeClass('active').hide();
        $(tabId).addClass('active').show();
    });
});
</script>
@endsection
