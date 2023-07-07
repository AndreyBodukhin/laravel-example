<?php

namespace App\SharedKernel\Infrastructure\Repositories;

use App\SharedKernel\Domain\Entity\AggregateRoot;
use App\SharedKernel\Domain\Entity\AggregateRootWithEvents;
use App\SharedKernel\Domain\Repositories\AggregateRootRepository;
use App\SharedKernel\Domain\Repositories\Exceptions\NotFoundException;

final class EventSourcingRepository implements AggregateRootRepository
{
    /**
     * @param EventStore $eventStore
     * @param class-string<AggregateRootWithEvents> $class
     */
    public function __construct(
        private readonly EventStore $eventStore,
        private readonly string $class
    )
    {
    }

    /**
     * @throws NotFoundException
     */
    public function get(string $id)
    {
        $events = $this->eventStore->findFor($id);
        if (empty($events)) {
            throw new NotFoundException($id);
        }
        return $this->class::wakeUp($events);
    }

    public function save(AggregateRoot $entity): void
    {
        $this->eventStore->saveFor($entity->getId()->value(), $this->class::popEvents($entity));
    }
}
