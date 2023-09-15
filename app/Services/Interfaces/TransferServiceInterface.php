<?php

namespace App\Services\Interfaces;

use App\Enum\TransferEnum;

interface TransferServiceInterface
{
    public function create(array $data);

    public function updateStatus(int $id, TransferEnum $status);
}
