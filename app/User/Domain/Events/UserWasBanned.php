<?php

namespace App\User\Domain\Events;

use App\SharedKernel\Domain\Events\AggregateRootEvent;

class UserWasBanned implements AggregateRootEvent
{
    public function __construct(
        public readonly string $reason
    )
    {
    }
}
