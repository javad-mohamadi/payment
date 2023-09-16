<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\BackofficeUserServiceInterface;

class BackofficeUserController extends Controller
{
    public function __construct(protected BackofficeUserServiceInterface $service)
    {
    }

    public function getTopThreeUsersTransactions()
    {
        $response = $this->service->getTopThreeUsersTransactions();

        return response()->json([
           'data' => $response
        ]);
    }
}
