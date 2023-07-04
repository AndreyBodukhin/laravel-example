<?php

namespace App\User\Entity;

use App\Shared\Domain\ValueObjects\GUID;
use App\User\ValueObjects\UserEmail;
use App\User\ValueObjects\UserName;

final class User
{
    public function __construct(
        public readonly GUID $id,
        public readonly UserName $userName,
        public readonly UserEmail $userName,
    )
    {
    }
}
