<?php

namespace App\Repositories;

use App\Models\UserPayment;
use App\Models\UserPlan;
use App\Models\User;
use Illuminate\Support\Str;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function createPayment(array $data)
    {
        return UserPayment::create([
            'id' => Str::uuid(),
            'plan_id' => $data['plan_id'],
            'user_id' => $data['user_id'],
            'price' => $data['price'],
            'payment_mode' => $data['payment_mode'],
            'stripe_payment_id' => $data['stripe_payment_id'],
            'status' => $data['status'],
        ]);
    }

    public function createUserPlan(array $data)
    {
        return UserPlan::create([
            'id' => Str::uuid(),
            'plan_id' => $data['plan_id'],
            'user_id' => $data['user_id'],
            'price' => $data['price'],
            'old_wallet' => $data['old_wallet'],
            'new_wallet' => $data['new_wallet'],
        ]);
    }

    public function updateUserWallet($userId, $amount)
    {
        $user = User::findOrFail($userId);
        $user->wallet += $amount;
        $user->save();
        return $user;
    }
}
