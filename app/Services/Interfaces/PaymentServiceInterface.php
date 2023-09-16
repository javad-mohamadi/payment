<?php

namespace App\Services\Interfaces;

use App\DTOs\Payment\TransferDto;

interface PaymentServiceInterface
{
    public function transfer(TransferDto $dto);
}
