<?php

namespace App\Http\Resources;

use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionsResource extends JsonResource
{
    public function toArray($request): Collection
    {
        return $this->mapTransactionsResponse($this->transactions);
    }

    private function mapTransactionsResponse($transactions): Collection
    {
        return collect($transactions)
            ->sortByDesc('created_at')
            ->slice(0, 10)
            ->values();
    }


}
