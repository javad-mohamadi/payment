<?php

namespace App\Criteria;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class GetThreeMostTransactionsUserIdsCriteria implements CriteriaInterface
{
    public function __constructor()
    {
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $time = now()->subMinutes(1000);

        return $model->with(['account:id,user_id'])
            ->select('account_id', DB::raw('COUNT(account_id) as transaction_count'))
            ->where('transactions.created_at', '>=', $time)
            ->groupBy('account_id')
            ->orderByDesc('transaction_count')
            ->limit(3)
            ->get()
            ->pluck('account.user_id');
    }
}
