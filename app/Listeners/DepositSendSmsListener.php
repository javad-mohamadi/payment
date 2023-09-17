<?php

namespace App\Listeners;

use App\Enum\ConfigEnum;
use App\Services\Sms\Sms;
use App\Events\TransferSendSmsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Interfaces\ConfigServiceInterface;
use App\Services\Interfaces\SmsLogServiceInterface;

class DepositSendSmsListener implements ShouldQueue
{
    public function __construct(
        private readonly SmsLogServiceInterface $smsLogService,
        private readonly ConfigServiceInterface $configService,
    ) {
    }

    public function handle(TransferSendSmsEvent $event): void
    {
        if (!isset($event->data['dest_user_id'])){
            return;
        }

        $mobile = $event->data['dest_mobile'];
        $userId = $event->data['dest_user_id'];
        $accountNumber = $event->data['dest_account_number'];
        $amount = $event->data['amount'];
        $date = $event->data['date'];
        $message = $this->configService->findByField('key', ConfigEnum::DEPOSIT)->value;
        $message = sprintf($message, $amount, $accountNumber, $date);
        $this->smsLogService->create($userId, $mobile, $message);
        Sms::make()->send($mobile, $message);
    }
}
