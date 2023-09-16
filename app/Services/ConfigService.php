<?php

namespace App\Services;

use App\Models\Config;
use App\Enum\ConfigEnum;
use App\Services\Interfaces\ConfigServiceInterface;
use App\Repositories\Config\ConfigRepositoryInterface;

class ConfigService implements ConfigServiceInterface
{

    public function __construct(private readonly ConfigRepositoryInterface $repository)
    {
    }

    public function findByField(string $field, ConfigEnum $value)
    {
        return $this->repository->findByField($field, $value->value)->first();
    }
}
