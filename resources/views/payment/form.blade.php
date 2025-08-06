@extends('front.include.app')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Complete Your Subscription</h3>
                </div>
                <div class="card-body">
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="plan-info mb-4">
                        <h4>{{ $plan->name }}</h4>
                        <p>Price: ${{ number_format($plan->price, 2) }}</p>
                        <p>You'll earn: {{ $plan->points }} points</p>
                    </div>

                    <form id="payment-form">
                        @csrf
                        <input type="hidden" name="payment_intent_id" id="payment-intent-id" value="{{ $clientSecret }}">

                        <!-- Cardholder Name -->
                        <div class="form-group mb-3">
                            <label for="cardholder-name">Cardholder Name</label>
                            <input type="text" class="form-control" id="cardholder-name" placeholder="Name on card" required>
                        </div>

                        <!-- Stripe Card Element -->
                        <div class="form-group mb-3">
                            <label>Card Details</label>
                            <div id="card-element" class="form-control p-2" style="height: 40px;"></div>
                            <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" id="submit-button">
                            Pay ${{ number_format($plan->price, 2) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Debugging: Verify Stripe key is loaded
    console.log('Stripe Key:', '{{ $stripeKey }}');

    const stripe = Stripe('{{ $stripeKey }}');
    const elements = stripe.elements();

    // Custom styling
    const style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create and mount card element
    const card = elements.create('card', {
        style: style,
        hidePostalCode: true
    });
    card.mount('#card-element');

    // Form submission
    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        console.log('Form submitted');

        const submitButton = document.getElementById('submit-button');
        submitButton.disabled = true;

        // Get cardholder name
        const cardholderName = document.getElementById('cardholder-name').value;
        if (!cardholderName) {
            document.getElementById('card-errors').textContent = 'Cardholder name is required';
            submitButton.disabled = false;
            return;
        }

        try {
            console.log('Confirming payment...');

            // Confirm card payment
            const { error, paymentIntent } = await stripe.confirmCardPayment(
                '{{ $clientSecret }}', {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: cardholderName
                        }
                    }
                }
            );

            if (error) {
                console.error('Stripe error:', error);
                document.getElementById('card-errors').textContent = error.message;
                submitButton.disabled = false;
                return;
            }

            console.log('PaymentIntent status:', paymentIntent.status);

            if (paymentIntent.status === 'succeeded') {
                console.log('Payment succeeded, submitting to server...');

                // Update hidden input with payment intent ID
                document.getElementById('payment-intent-id').value = paymentIntent.id;

                // Submit to server
                const response = await fetch('{{ route("payment.process", $plan->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        payment_intent_id: paymentIntent.id
                    })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const result = await response.json();
                console.log('Server response:', result);

                if (result.success) {
                    window.location.href = result.redirect_url || '{{ route("payment.success") }}';
                } else {
                    throw new Error(result.message || 'Payment failed');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('card-errors').textContent = error.message;
            submitButton.disabled = false;
        }
    });

    // Debugging: Verify elements mounted
    console.log('Stripe Elements initialized');
</script>
@endsection
