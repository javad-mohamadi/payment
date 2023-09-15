<?php

namespace App\Criteria;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindActiveDynamicPasswordCriteria implements CriteriaInterface
{

    public function __construct(
        private readonly int    $cardId,
        private readonly int    $destCardNumber,
        private readonly int    $amount,
        private readonly Carbon $time,
    ) {
    }

    public function apply($model, RepositoryInterface $repository): Builder
    {
        return $model->where('card_id', $this->cardId)
                    ->where('dest_card_number', $this->destCardNumber)
                    ->where('amount', $this->amount)
                    ->where('created_at', '>=', $this->time);
    }
}
