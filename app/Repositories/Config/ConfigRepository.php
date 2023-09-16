<?php

namespace App\Repositories\Config;

use App\Models\Config;
use App\Repositories\Repository;

class ConfigRepository extends Repository implements ConfigRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Config::class;
    }
}
