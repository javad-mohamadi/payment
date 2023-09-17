<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:update-limit-static-password-transfer-amount-command')
            ->cron('0 0 * * *')->withoutOverlapping()->timezone('Asia/Tehran');

        $schedule->command('app:update-limit-dynamic-password-transfer-amount-command')
            ->cron('0 0 * * *')->withoutOverlapping()->timezone('Asia/Tehran');

        $schedule->command('app:remove-used-and-expired-card-dynamic-second-password-command')
            ->cron('0 0 * * *')->withoutOverlapping()->timezone('Asia/Tehran');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
