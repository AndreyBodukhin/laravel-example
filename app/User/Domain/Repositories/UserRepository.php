<?php

namespace App\User\Domain\Repositories;

use App\User\Domain\Entity\User;
use App\User\Domain\Repositories\Exceptions\UserNotFoundException;

interface UserRepository
{
    /**
     * @throws UserNotFoundException
     */
    public function get(string $userId): User;

    public function save(User $user);
}
