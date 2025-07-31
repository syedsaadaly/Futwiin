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



    <section class="footerball-sec leagues-footerball">
        <div class="container">
            <div class="footerball-top" data-aos="fade-up" data-duration="4000">
                <h2 class="mainHead">Comprehensive Football Coverage</h2>
                <p>Expert analysis and predictions for Europe's top domestic leagues and premier international competitions including Champions League, Europa League, and Nations League.</p>
            </div>
            <div class="row" data-aos="fade-up" data-duration="4000">
                <div class="col-md-12">
                    <div class="btn-group">
                        <a href="">Domestic Leagues </a>
                        <a href="">International</a>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="footeball-tabs">
                                <ul id="tabs-nav">
                                    <li><a href="#tab1">Premier League</a></li>
                                    <li><a href="#tab2">La Liga</a></li>
                                    <li><a href="#tab3">Bundesliga</a></li>
                                    <li><a href="#tab4">Serie A</a></li>
                                    <li><a href="#tab5">Ligue 1</a></li>
                                </ul>
                                <div id="tabs-content">
                                    <div id="tab1" class="tab-content">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <figure class="football-imag">
                                                    <img src="images/football1.webp" class="img-fluid" alt="">
                                                </figure>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="football-wrapp">
                                                    <div class="football-content">
                                                        <h4> Premier League</h4>
                                                        <p> England’s top flight offers some of the most exciting and competitive football in the world.</p>
                                                        <ul class="football-list">
                                                            <li><a href=""><i class="far fa-check-circle"></i> 20 teams coverage</a></li>
                                                            <li><a href=""><i class="far fa-check-circle"></i>90% prediction accuracy</a></li>
                                                            <li><a href=""><i class="far fa-check-circle"></i>380 matches per season</a></li>
                                                        </ul>
                                                        <a href="" class="themeBtn">Get Premier League Picks</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab2" class="tab-content">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <figure class="football-imag">
                                                    <img src="{{ asset('front/images/football2.webp ') }}" class="img-fluid" alt="">
                                                </figure>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="football-wrapp">
                                                    <div class="football-content">
                                                        <h4>
                                                            La Liga</h4>
                                                        <p> Spain’s premier competition showcases some of the world’s most technically gifted players.</p>
                                                        <ul class="football-list">
                                                            <li><a href=""><i class="far fa-check-circle"></i> 20 teams coverage</a></li>
                                                            <li><a href=""><i class="far fa-check-circle"></i>90% prediction accuracy</a></li>
                                                            <li><a href=""><i class="far fa-check-circle"></i>380 matches per season</a></li>
                                                        </ul>
                                                        <a href="" class="themeBtn">Get Premier League Picks</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab3" class="tab-content">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <figure class="football-imag">
                                                    <img src="images/football3.webp" class="img-fluid" alt="">
                                                </figure>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="football-wrapp">
                                                    <div class="football-content">
                                                        <h4>Bundesliga</h4>
                                                        <p> Germany’s top league is known for high-scoring matches and passionate fan atmospheres.</p>
                                                        <ul class="football-list">
                                                            <li><a href=""><i class="far fa-check-circle"></i> 20 teams coverage</a></li>
                                                            <li><a href=""><i class="far fa-check-circle"></i>90% prediction accuracy</a></li>
                                                            <li><a href=""><i class="far fa-check-circle"></i>380 matches per season</a></li>
                                                        </ul>
                                                        <a href="" class="themeBtn">Get Premier League Picks</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab4" class="tab-content">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <figure class="football-imag">
                                                    <img src="images/football4.webp" class="img-fluid" alt="">
                                                </figure>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="football-wrapp">
                                                    <div class="football-content">
                                                        <h4>
                                                            Serie A</h4>
                                                        <p> Italy’s Serie A is famous for tactical sophistication and defensive excellence.</p>
                                                        <ul class="football-list">
                                                            <li><a href=""><i class="far fa-check-circle"></i> 20 teams coverage</a></li>
                                                            <li><a href=""><i class="far fa-check-circle"></i>90% prediction accuracy</a></li>
                                                            <li><a href=""><i class="far fa-check-circle"></i>380 matches per season</a></li>
                                                        </ul>
                                                        <a href="" class="themeBtn">Get Premier League Picks</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab5" class="tab-content">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <figure class="football-imag">
                                                    <img src="images/football5.webp" class="img-fluid" alt="">
                                                </figure>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="football-wrapp">
                                                    <div class="football-content">
                                                        <h4> Ligue 1</h4>
                                                        <p>
                                                            France’s top division is a showcase for emerging talents and established stars.</p>
                                                        <ul class="football-list">
                                                            <li><a href=""><i class="far fa-check-circle"></i> 20 teams coverage</a></li>
                                                            <li><a href=""><i class="far fa-check-circle"></i>90% prediction accuracy</a></li>
                                                            <li><a href=""><i class="far fa-check-circle"></i>380 matches per season</a></li>
                                                        </ul>
                                                        <a href="" class="themeBtn">Get Premier League Picks</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
