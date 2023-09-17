<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class UpdateLimitDynamicPasswordTransferAmount implements CriteriaInterface
{
    public function __constructor()
    {
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $limit = (int)config('transfer.limit_dynamic_password_transfer');

        return $model->where('limit_dynamic_password_transfer', '<', $limit)
            ->update(['limit_dynamic_password_transfer' => $limit]);
    }
}
