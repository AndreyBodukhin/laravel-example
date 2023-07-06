<?php

namespace App\User\Application\CommandHandlers;

use App\SharedKernel\Domain\Services\GuidGenerator;
use App\SharedKernel\Domain\ValueObjects\EmailAddress;
use App\User\Application\Commands\RegisterUser;
use App\User\Application\Services\PasswordHasher;
use App\User\Domain\Entity\User;
use App\User\Domain\Repositories\UserRepository;
use App\User\Domain\ValueObjects\UserName;
use App\User\Domain\ValueObjects\UserPassword;

class RegisterUserHandler
{
    public function __construct(
        private readonly UserRepository $repository,
        private readonly PasswordHasher $hasher,
        private readonly GuidGenerator $guid
    )
    {
    }

    public function __invoke(RegisterUser $command): string
    {
        $user = User::register(
            $this->guid->next(),
            UserName::create($command->name),
            EmailAddress::create($command->email),
            UserPassword::create($this->hasher->hash($command->password))
        );
        $this->repository->save($user);
        return $user->getId()->value();
    }
}
