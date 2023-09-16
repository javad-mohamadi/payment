<?php

namespace App\Services\Interfaces;

use App\Models\Card;
use App\DTOs\Payment\TransferDTO;

interface CardDynamicPasswordServiceInterface
{
    public function checkPassword(Card $card, TransferDTO $dto);
    public function removeUsedPassword();
}
