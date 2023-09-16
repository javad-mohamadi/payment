<?php

namespace App\Criteria;

use Carbon\Carbon;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class DeleteUsedAndExpiredCardDynamicPasswordCriteria implements CriteriaInterface
{
    public function __construct(private readonly Carbon $time)
    {
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('created_at', '<', $this->time)->orWhere('used', 1)->delete();
    }
}
