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
    <div class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $cmsContent->banner_title ?? 'Expert Picks' }}</h2>
                </div>
            </div>
        </div>
    </div>


    <section class="pick-sec Expert-pick">
        <div class="container">
            <div class="pick-top text-center" data-aos="fade-up" data-duration="4000">
                <h2>{{ $cmsContent->main_heading ?? 'Todays Featured Picks' }}</h2>

                <p>{{ $cmsContent->main_paragraph ?? 'Preview our expert predictions...' }}</p>

            </div>
            <div class="row justify-content-center" data-aos="fade-up" data-duration="4000">
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
                                        alt="{{ $prediction->team1->name }} vs {{ $prediction->team2->name }}">
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

                @if ($showRegisterButton)
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
                        <p>Join thousands of members who have transformed their betting results with FutWin’s <br> premium
                            analysis</p>
                        <div class="btn-group">
                            <a href="#">Join FutWin Today</a>
                            <a href="#">Join FutWin Today</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="predictionModal" tabindex="-1" aria-labelledby="predictionModalLabel" aria-hidden="true">
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
