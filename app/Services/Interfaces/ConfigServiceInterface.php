<?php

namespace App\Services\Interfaces;

use App\Enum\ConfigEnum;

interface ConfigServiceInterface
{
    public function findByField(string $field, ConfigEnum $value);
}
