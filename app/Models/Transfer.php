<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    protected $fillable = [
        'source_card_id',
        'dest_card_id',
        'dest_card_number',
        'dest_bank',
        'amount',
        'status',
    ];

    public function sourceCard(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'source_card_id');
    }

    public function destCard(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'dest_card_id');
    }

    public function transactionFee(): HasOne
    {
        return $this->hasOne(TransactionFee::class);
    }
}

