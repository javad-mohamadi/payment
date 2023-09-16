<?php

namespace App\Providers;

use App\Services\Sms\SmsFactory;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('sms', function () {
            return new SmsFactory();
        });
    }

    public function boot()
    {
    }
}

