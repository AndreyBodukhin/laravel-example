<?php

namespace App\User\Infrastructure\Domain\Repositories;

use App\SharedKernel\Domain\Repositories\Exceptions\NotFoundException;
use App\SharedKernel\Infrastructure\Repositories\EventSourcingRepository;
use App\SharedKernel\Infrastructure\Repositories\EventStore;
use App\User\Domain\Entity\User;
use App\User\Domain\Repositories\Exceptions\UserNotFoundException;
use App\User\Domain\Repositories\UserRepository as UserRepositoryInterface;

//TODO: Rename
final class UserRepository implements UserRepositoryInterface
{
    private EventSourcingRepository $repository;
    public function __construct(EventStore $eventStore)
    {
        $this->repository = new EventSourcingRepository($eventStore, User::class);
    }

    public function get(string $userId): User
    {
        try {
            return $this->repository->get($userId);
        } catch (NotFoundException $e) {
            throw new UserNotFoundException($userId);
        }
    }

    public function save(User $user)
    {
        $this->repository->save($user);
    }
}
