<?php

namespace App\Repositories\Card;

use App\Models\Card;
use App\Repositories\Repository;

class CardRepository extends Repository implements CardRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Card::class;
    }
}
