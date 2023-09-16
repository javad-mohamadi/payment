<?php

namespace App\Repositories\Transfer;

use App\Models\Transfer;
use App\Repositories\Repository;

class TransferRepository extends Repository implements TransferRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Transfer::class;
    }
}
