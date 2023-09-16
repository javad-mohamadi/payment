<?php

namespace App\Providers;

use App\Services\CardService;
use App\Services\ConfigService;
use App\Services\PaymentService;
use App\Services\AccountService;
use App\Services\SmsLogService;
use App\Services\TransferService;
use App\Services\TransactionService;
use Illuminate\Support\ServiceProvider;
use App\Services\TransactionFeeService;
use App\Services\BackofficeUserService;
use App\Services\AuthenticationService;
use App\Services\CardDynamicPasswordService;
use App\Services\Interfaces\CardServiceInterface;
use App\Services\Interfaces\ConfigServiceInterface;
use App\Services\Interfaces\SmsLogServiceInterface;
use App\Services\Interfaces\AccountServiceInterface;
use App\Services\Interfaces\PaymentServiceInterface;
use App\Services\Interfaces\TransferServiceInterface;
use App\Services\Interfaces\TransactionServiceInterface;
use App\Services\Interfaces\AuthenticationServiceInterface;
use App\Services\Interfaces\TransactionFeeServiceInterface;
use App\Services\Interfaces\BackofficeUserServiceInterface;
use App\Services\Interfaces\CardDynamicPasswordServiceInterface;

class ServiceLayerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
        $this->app->bind(PaymentServiceInterface::class, PaymentService::class);
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
        $this->app->bind(AccountServiceInterface::class, AccountService::class);
        $this->app->bind(CardServiceInterface::class, CardService::class);
        $this->app->bind(CardDynamicPasswordServiceInterface::class, CardDynamicPasswordService::class);
        $this->app->bind(TransactionFeeServiceInterface::class, TransactionFeeService::class);
        $this->app->bind(TransferServiceInterface::class, TransferService::class);
        $this->app->bind(SmsLogServiceInterface::class, SmsLogService::class);
        $this->app->bind(ConfigServiceInterface::class, ConfigService::class);
        $this->app->bind(BackofficeUserServiceInterface::class, BackofficeUserService::class);
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
