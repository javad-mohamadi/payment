<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'type',
        'cvv2',
        'static_second_password',
        'limit_dynamic_password_transfer',
        'limit_static_password_transfer',
        'expire_date',
        'account_id',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function cardDynamicPasswords(): HasMany
    {
        return $this->hasMany(CardDynamicPassword::class);
    }

    public function transfer(): HasOne
    {
        return $this->hasOne(Transfer::class);
    }
}

