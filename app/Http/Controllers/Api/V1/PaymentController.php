<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\DTOs\Payment\TransferDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransferPaymentRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Interfaces\PaymentServiceInterface;

class PaymentController extends Controller
{
    /**
     * @param PaymentServiceInterface $service
     */
    public function __construct(protected PaymentServiceInterface $service)
    {
    }

    /**
     * @param TransferPaymentRequest $request
     * @return JsonResponse
     */
    public function transfer(TransferPaymentRequest $request): JsonResponse
    {
        $dto = TransferDTO::getFromRequest($request->user(), $request->validated());
        $response = $this->service->transfer($dto);

        return response()->json([
            'message' => $response
        ], Response::HTTP_OK);
    }
}
