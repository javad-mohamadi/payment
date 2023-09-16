<?php

namespace App\Services;

use App\Repositories\TransactionFee\TransactionFeeRepositoryInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Services\Interfaces\TransactionFeeServiceInterface;

class TransactionFeeService implements TransactionFeeServiceInterface
{

    public function __construct(
        protected TransactionFeeRepositoryInterface $repository
    ) {
    }

    /**
     * @throws ValidatorException
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}
