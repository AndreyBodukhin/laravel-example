<?php

namespace App\User\Application\Commands;

final class RegisterUser
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    )
    {
    }
}
