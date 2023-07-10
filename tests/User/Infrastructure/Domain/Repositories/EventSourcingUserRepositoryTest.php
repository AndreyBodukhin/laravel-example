<?php

namespace Tests\User\Infrastructure\Domain\Repositories;

use App\SharedKernel\Domain\ValueObjects\EmailAddress;
use App\SharedKernel\Domain\ValueObjects\GUID;
use App\SharedKernel\Infrastructure\Repositories\EventStore;
use App\User\Domain\Entity\User;
use App\User\Domain\Repositories\Exceptions\UserNotFoundException;
use App\User\Domain\ValueObjects\UserName;
use App\User\Domain\ValueObjects\UserPassword;
use App\User\Infrastructure\Domain\Repositories\EventSourcingUserRepository;
use PHPUnit\Framework\TestCase;

class EventSourcingUserRepositoryTest extends TestCase
{
    private EventSourcingUserRepository $repository;
    protected function setUp(): void
    {
        $eventStore = new class implements EventStore {
            private array $records = [];
            public function findFor(string $id): array
            {
                return $this->records[$id] ?? [];
            }

            public function saveFor(string $id, array $events): void
            {
                $this->records[$id] = array_merge($this->records[$id] ?? [], $events);
            }
        };

        $this->repository = new EventSourcingUserRepository($eventStore);
    }

    public function test_get()
    {
        $user = User::register(
            GUID::create('guid'),
            UserName::create('name'),
            EmailAddress::create('test@test.ru'),
            UserPassword::create('password')
        );
        $this->repository->save($user);

        $savedUser = $this->repository->get($user->getId()->value());

        $this->assertTrue($user->getId()->equalsTo($savedUser->getId()));
        $this->assertTrue($user->getName()->equalsTo($savedUser->getName()));
        $this->assertTrue($user->getEmail()->equalsTo($savedUser->getEmail()));
        $this->assertTrue($user->getPassword()->equalsTo($savedUser->getPassword()));

        $this->assertEquals($user->isBaned(), $savedUser->isBaned());
        $this->assertEquals($user->isActive(), $savedUser->isActive());
        $this->assertEquals($user->isVerified(), $savedUser->isVerified());
    }

    public function test_get_with_invalid_id()
    {
        $this->expectException(UserNotFoundException::class);

        $this->repository->get('id');
    }
}
