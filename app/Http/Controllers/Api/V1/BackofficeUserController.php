<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\BackofficeUserServiceInterface;
use App\Http\Resources\GetThreeMostTransactionsUsersResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BackofficeUserController extends Controller
{
    public function __construct(protected BackofficeUserServiceInterface $service)
    {
    }

    public function getTopThreeUsersTransactions(): AnonymousResourceCollection
    {
        $response = $this->service->getTopThreeUsersTransactions();

        return GetThreeMostTransactionsUsersResource::collection($response);
    }
}
