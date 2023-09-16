<?php

namespace App\Listeners;

use App\Enum\ConfigEnum;
use App\Events\TransferSendSmsEvent;
use App\Services\Interfaces\ConfigServiceInterface;
use App\Services\Interfaces\SmsLogServiceInterface;
use App\Services\Sms\Sms;
use App\Services\Sms\SmsServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;

class WithdrawSendSmsListener implements ShouldQueue
{
    public function __construct(
        private readonly SmsLogServiceInterface $smsLogService,
        private readonly ConfigServiceInterface $configService,
    )
    {
    }

    public function handle(TransferSendSmsEvent $event): void
    {
        $mobile = $event->data['source_mobile'];
        $userId = $event->data['source_user_id'];
        $accountNumber = $event->data['source_account_number'];
        $amount = $event->data['amount'];
        $date = $event->data['date'];

        $message = $this->configService->findByField('key', ConfigEnum::WITHDRAW)->value;
        $message = sprintf($message, $amount, $accountNumber, $date);
        $this->smsLogService->create($userId, $mobile, $message);
        Sms::make()->send($mobile, $message);
    }
}
