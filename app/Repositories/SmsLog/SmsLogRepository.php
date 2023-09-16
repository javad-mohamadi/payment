<?php

namespace App\Repositories\SmsLog;

use App\Models\SmsLogs;
use App\Repositories\Repository;

class SmsLogRepository extends Repository implements SmsLogRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return SmsLogs::class;
    }
}
