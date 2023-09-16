<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Card\CardRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\SmsLog\SmsLogRepository;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Account\AccountRepository;
use App\Repositories\Transfer\TransferRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Card\CardRepositoryInterface;
use App\Repositories\Config\ConfigRepositoryInterface;
use App\Repositories\SmsLog\SmsLogRepositoryInterface;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Account\AccountRepositoryInterface;
use App\Repositories\Transfer\TransferRepositoryInterface;
use App\Repositories\TransactionFee\TransactionFeeRepository;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use App\Repositories\TransactionFee\TransactionFeeRepositoryInterface;
use App\Repositories\CardDynamicPassword\CardDynamicPasswordRepository;
use App\Repositories\CardDynamicPassword\CardDynamicPasswordRepositoryInterface;

class ServiceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->bind(CardRepositoryInterface::class, CardRepository::class);
        $this->app->bind(CardDynamicPasswordRepositoryInterface::class, CardDynamicPasswordRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(TransactionFeeRepositoryInterface::class, TransactionFeeRepository::class);
        $this->app->bind(TransferRepositoryInterface::class, TransferRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SmsLogRepositoryInterface::class, SmsLogRepository::class);
        $this->app->bind(ConfigRepositoryInterface::class, ConfigRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
