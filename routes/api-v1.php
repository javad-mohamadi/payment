<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PaymentController;

Route::group(['prefix' => 'payment'], function () {
    Route::post('transfer', [PaymentController::class, 'transfer'])->name('transfer-payment');
});
