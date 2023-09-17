<?php

namespace App\Services\Interfaces;

use App\Models\Card;

interface CardServiceInterface
{
    public function find(int $id);

    public function findByCardNumber(string $cardNumber);

    public function update(int $id, array $data);

    public function checkCvv2(Card $card, string $cvv2);

    public function updateLimitStaticPasswordTransferAmount();

    public function updateLimitDynamicPasswordTransferAmount();
}
