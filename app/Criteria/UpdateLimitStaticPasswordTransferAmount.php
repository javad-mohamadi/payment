<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class UpdateLimitStaticPasswordTransferAmount implements CriteriaInterface
{
    public function __constructor()
    {
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $limit = (int)config('transfer.limit_static_password_transfer');

        return $model->where('limit_static_password_transfer', '<', $limit)
            ->update(['limit_static_password_transfer' => $limit]);
    }
}
