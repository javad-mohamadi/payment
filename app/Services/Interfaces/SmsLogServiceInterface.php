<?php

namespace App\Services\Interfaces;

interface SmsLogServiceInterface
{
    public function create(int $userId, string $mobile, string $message);
}
