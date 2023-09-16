<?php

namespace App\Services;

use Exception;
use App\Models\Card;
use App\Services\Interfaces\CardServiceInterface;
use App\Repositories\Card\CardRepositoryInterface;
use App\Criteria\UpdateLimitStaticPasswordTransferAmount;

class CardService implements CardServiceInterface
{

    public function __construct(private readonly CardRepositoryInterface $repository)
    {
    }

    function find(int $id): Card
    {
        return $this->repository->find($id);
    }

    public function findByCardNumber(string $cardNumber): ?Card
    {
        return $this->repository->findByField('number', $cardNumber)->first();
    }

    public function update(int $id, array $data): void
    {
        $this->repository->update($data, $id);
    }

    public function checkCvv2(Card $card, string $cvv2)
    {
        if ($card->cvv2 != $cvv2) {
            throw new Exception('cvv2 is not valid');
        }
    }

    public function updateLimitStaticPasswordTransferAmount()
    {
        $this->repository->pushCriteria(new UpdateLimitStaticPasswordTransferAmount());
    }
}
