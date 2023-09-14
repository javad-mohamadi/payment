<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    protected $fillable = [
        'source_account_number',
        'destination_account_number',
        'amount',
        'transaction_type',
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function transactionFee(): HasOne
    {
        return $this->hasOne(TransactionFee::class);
    }
}

