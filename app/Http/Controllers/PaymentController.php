<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\UserPayment;
use App\Models\UserPlan;
use App\Repositories\PaymentRepositoryInterface;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $paymentRepo;

    public function __construct(PaymentRepositoryInterface $paymentRepo)
    {
        $this->paymentRepo = $paymentRepo;
    }

    public function showPaymentForm($planId)
    {
        if (!auth()->check()) {
            return redirect()->route('register', ['plan' => $planId]);
        }

        $plan = Plan::findOrFail($planId);

        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $plan->price * 100,
            'currency' => 'usd',
            'description' => $plan->name . ' subscription',
            'metadata' => [
                'plan_id' => $plan->id,
                'user_id' => auth()->user()->id
            ],
        ]);

        return view('payment.form', [
            'plan' => $plan,
            'stripeKey' => config('services.stripe.key'),
            'clientSecret' => $paymentIntent->client_secret
        ]);
    }

    public function processPayment(Request $request, $planId)
    {
        $user = auth()->user();
        $plan = Plan::findOrFail($planId);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

            if ($paymentIntent->status !== 'succeeded') {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment not completed. Status: ' . $paymentIntent->status
                ], 400);
            }

            $this->paymentRepo->createPayment([
                'plan_id' => $plan->id,
                'user_id' => $user->id,
                'price' => $plan->price,
                'payment_mode' => 'stripe',
                'stripe_payment_id' => $paymentIntent->id,
                'status' => 'completed',
            ]);

            $oldWallet = $user->wallet;
            $user = $this->paymentRepo->updateUserWallet($user->id, $plan->points);
            $user->plan_id = $plan->id;
            $user->save();

            $this->paymentRepo->createUserPlan([
                'plan_id' => $plan->id,
                'user_id' => $user->id,
                'price' => $plan->price,
                'old_wallet' => $oldWallet,
                'new_wallet' => $user->wallet,
            ]);

            session()->flash('plan', $plan);

            return response()->json([
                'success' => true,
                'redirect_url' => route('payment.success')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function paymentSuccess()
    {
        $plan = session('plan');

        if (!$plan) {
            return redirect()->route('front.index')->with('error', 'Invalid payment session');
        }

        return view('payment.success', ['plan' => $plan]);
    }
}
