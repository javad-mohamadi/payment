<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsLogs extends Model
{
    protected $fillable = [
      'user_id',
      'mobile',
      'message',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}

