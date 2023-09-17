<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Interfaces\CardServiceInterface;

class UpdateLimitDynamicPasswordTransferAmountCommand extends Command
{
    protected $signature = 'app:update-limit-dynamic-password-transfer-amount-command';

    protected $description = 'Command description';

    public function __construct(private readonly CardServiceInterface $cardService)
    {
        parent::__construct();
    }

    public function handle()
    {
        return $this->cardService->updateLimitDynamicPasswordTransferAmount();
    }
}
