<?php

namespace App\SharedKernel\Infrastructure\Repositories;

use App\SharedKernel\Domain\Events\AggregateRootEvent;

interface EventStore
{
    /**
     * @return AggregateRootEvent[]
     */
    public function findFor(string $id): array;

    /**
     * @param string $id
     * @param AggregateRootEvent[] $events
     */
    public function saveFor(string $id, array $events): void;
}
