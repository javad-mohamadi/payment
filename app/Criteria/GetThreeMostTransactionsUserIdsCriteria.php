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
        $time = now()->subMinutes(10);

        return $model->join('accounts', 'transactions.account_id', '=', 'accounts.id')
            ->select('accounts.user_id', DB::raw('COUNT(transactions.account_id) as transaction_count'))
            ->where('transactions.created_at', '>=', $time)
            ->groupBy('accounts.user_id')
            ->orderByDesc('transaction_count')
            ->limit(3)
            ->get()
            ->pluck('user_id');
    }
}
