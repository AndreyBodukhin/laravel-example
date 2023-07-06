<?php

namespace App\User\Application\Services;

interface PasswordHasher
{
    public function hash(string $password): string;
}
