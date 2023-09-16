<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\BackofficeUserController;

Route::group(['prefix' => 'payments'], function () {
    Route::post('transfer', [PaymentController::class, 'transfer'])->name('payment_transfer');
});

Route::group(['prefix' => 'backoffice'], function () {
    Route::group(['prefix' => 'transactions'], function () {
        Route::get('', [BackofficeUserController::class, 'getTopThreeUsersTransactions'])
            ->name('backoffice_get_users_transactions');
    });
});
