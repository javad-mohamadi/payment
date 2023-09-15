<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Interfaces\CardServiceInterface;

class UpdateLimitStaticPasswordTransferAmountCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-limit-static-password-transfer-amount-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(private readonly CardServiceInterface $cardService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        return $this->cardService->updateLimitStaticPasswordTransferAmount();
    }
}
