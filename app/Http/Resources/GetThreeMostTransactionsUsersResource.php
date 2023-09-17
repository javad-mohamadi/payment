<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetThreeMostTransactionsUsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id'      => $this->id,
            'name'         => $this->name,
            'mobile'       => $this->mobile,
            'transactions' => $this->prepareTransactions(),
        ];
    }

    private function prepareTransactions(): array
    {
        $transactions = collect();
        foreach ($this->accounts as $account) {
            $transactions = $transactions->merge($account->transactions->take(10));
        }

        return $transactions->sortByDesc('created_at')->take(10)->toArray();
    }
}
