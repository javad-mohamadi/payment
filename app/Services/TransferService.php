<?php

namespace App\Services;

use App\Models\Transfer;
use App\Enum\TransferEnum;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Services\Interfaces\TransferServiceInterface;
use App\Repositories\Transfer\TransferRepositoryInterface;

class TransferService implements TransferServiceInterface
{
    /**
     * @param TransferRepositoryInterface $repository
     */
    public function __construct(protected TransferRepositoryInterface $repository)
    {
    }

    /**
     * @throws ValidatorException
     */
    public function create(array $data): Transfer
    {
        return $this->repository->create($data);
    }

    /**
     * @throws ValidatorException
     */
    public function updateStatus(int $id, TransferEnum $status): void
    {
        $this->repository->update(['status' => $status->value], $id);
    }
}
