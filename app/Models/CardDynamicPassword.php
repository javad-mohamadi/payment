<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardDynamicPassword extends Model
{

    protected $fillable = [
        'card_id',
        'dest_card_number',
        'amount',
        'password',
        'used',
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}

