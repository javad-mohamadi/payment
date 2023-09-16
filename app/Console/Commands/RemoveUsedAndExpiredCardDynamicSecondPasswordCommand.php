<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Interfaces\CardDynamicPasswordServiceInterface;

class RemoveUsedAndExpiredCardDynamicSecondPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-used-and-expired-card-dynamic-second-password-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will be removed all second password that is used and expired';

    public function __construct(private readonly CardDynamicPasswordServiceInterface $dynamicPasswordService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        return $this->dynamicPasswordService->removeUsedPassword();
    }
}
