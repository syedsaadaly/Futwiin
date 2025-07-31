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
                <div class="col-md-4">
                    <div class="pick-wrapp">
                        <figure class="pick-imag">
                            <img src="{{ asset('front/images/pick.webp') }}" class="img-fluid" alt="">
                        </figure>
                        <div class="pick-content">
                            <ul class="pick-list">
                                <li><a href=""><span>FIFA Club World Cup</span>Jun 25, 6:00 PM</a></li>
                            </ul>
                            <h3>Flamengo RJ vs. Chelsea FC</h3>
                            <div class="pick-center">
                                <div class="pick-main">
                                    <div class="pick-counter">
                                        <h5>Fl</h5>
                                        <span>Flamengo</span>
                                    </div>
                                    <h6>vs</h6>
                                    <div class="pick-counter">
                                        <span>Chelsea</span>
                                        <h5>Ch</h5>
                                    </div>
                                </div>
                            </div>
                            <p>🔥 Flamengo RJ vs Chelsea 🕐 Kickoff: June 20, 2025 – 1:00 PM ✅ Pick: Chelsea Total Goals Under 2.5 🔍 Analysis: Chel… </p>
                            <div class="pick-bottom">
                                <a href="">82% Success Rate</a>
                                <a href="">Full Analysis<i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pick-wrapp">
                        <figure class="pick-imag">
                            <img src="{{ asset('front/images/pic2.webp') }}" class="img-fluid" alt="">
                        </figure>
                        <div class="pick-content">
                            <ul class="pick-list">
                                <li><a href=""><span>FIFA Club World Cup</span>Jun 26, 1:00 AM</a></li>
                            </ul>
                            <h3>Bayern Munich vs. Boca Juniors</h3>
                            <div class="pick-center">
                                <div class="pick-main">
                                    <div class="pick-counter">
                                        <h5>Ba
                                        </h5>
                                        <span>
                                            Bayern</span>
                                    </div>
                                    <h6>vs</h6>
                                    <div class="pick-counter">
                                        <span>
                                            Boca</span>
                                        <h5>Bo</h5>
                                    </div>
                                </div>
                            </div>
                            <p>🔥 Bayern Munich vs Boca Juniors 🕗 Kickoff: June 20, 2025 – 8:00 PM ✅ Pick: Boca Juniors Total Goals Under 1.5 🔍 Ana </p>
                            <div class="pick-bottom">
                                <a href="">82% Success Rate</a>
                                <a href="">Full Analysis<i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <a href="register.php" class="themeBtn">Access All Premium Picks</a>
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
