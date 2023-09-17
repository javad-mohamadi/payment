<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class GetUsersTransactionsCriteria implements CriteriaInterface
{
    public function __construct(private readonly array $ids)
    {
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->whereIn('id', $this->ids)->with('accounts.transactions')->get();
    }
}
