<?php

namespace App\Services;

use App\Services\Interfaces\SmsLogServiceInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\SmsLog\SmsLogRepositoryInterface;

class SmsLogService implements SmsLogServiceInterface
{

    public function __construct(private readonly SmsLogRepositoryInterface $repository)
    {
    }

    /**
     * @throws ValidatorException
     */
    public function create(int $userId, string $mobile, string $message): void
    {
        $data = [
            'user_id' => $userId,
            'mobile' => $mobile,
            'message' => $message
        ];

        $this->repository->create($data);
    }
}
