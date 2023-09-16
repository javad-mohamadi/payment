<?php

namespace App\DTOs\Payment;

use App\Models\User;

class TransferDTO
{
    public function __construct(
        public int    $userId,
        public int    $sourceCardId,
        public string $destCardNumber,
        public int    $amount,
        public string $cvv2,
        public string $password
    )
    {
    }

    public static function getFromRequest(User $user, array $request): TransferDTO
    {
        return new static(
            $user->id,
            $request['source_card_id'],
            $request['dest_card_number'],
            $request['amount'],
            $request['cvv2'],
            $request['password'],
        );
    }
}
