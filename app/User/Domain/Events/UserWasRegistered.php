<?php

namespace App\User\Domain\Events;

use App\SharedKernel\Domain\Events\AggregateRootEvent;
use App\SharedKernel\Domain\ValueObjects\GUID;
use App\User\Domain\ValueObjects\UserEmail;
use App\User\Domain\ValueObjects\UserName;
use App\User\Domain\ValueObjects\UserPassword;

class UserWasRegistered implements AggregateRootEvent
{
    public function __construct(
        public readonly GUID         $id,
        public readonly UserName     $name,
        public readonly UserEmail    $email,
        public readonly UserPassword $password
    )
    {
    }
}
