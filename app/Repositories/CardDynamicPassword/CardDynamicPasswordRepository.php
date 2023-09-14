<?php

namespace App\Repositories\CardDynamicPassword;

use App\Repositories\Repository;
use App\Models\CardDynamicPassword;

class CardDynamicPasswordRepository extends Repository implements CardDynamicPasswordRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return CardDynamicPassword::class;
    }
}
