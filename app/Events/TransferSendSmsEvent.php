<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class TransferSendSmsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public readonly array $data)
    {
    }

    public function broadcastOn(): array
    {
        return [];
    }
}
