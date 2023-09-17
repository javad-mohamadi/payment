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
            'transactions' => TransactionsResource::collection($this->whenLoaded('accounts'))
        ];
    }
}
