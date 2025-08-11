<?php

namespace App\Repositories;

interface PaymentRepositoryInterface
{
    public function createPayment(array $data);
    public function createUserPlan(array $data);
    public function updateUserWallet($userId, $amount);
}
