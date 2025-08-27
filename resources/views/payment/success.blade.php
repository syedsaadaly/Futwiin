@extends('front.include.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3>Payment Successful</h3>
                    </div>
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-5x text-success mb-4"></i>
                        <h4>Thank you for your subscription!</h4>
                        <p>Your payment was processed successfully.</p>

                        @isset($plan)
                            <p>Your wallet has been credited with {{ $plan->points }} points.</p>
                        @endisset

                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                            Go to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
