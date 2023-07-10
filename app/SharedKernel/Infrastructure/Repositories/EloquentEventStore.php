<?php

namespace App\SharedKernel\Infrastructure\Repositories;

use App\SharedKernel\Domain\Events\AggregateRootEvent;
use App\SharedKernel\Infrastructure\Models\EventModel;

final class EloquentEventStore implements EventStore
{
    public function findFor(string $id): array
    {
        return EventModel::where('entity_id', '=', $id)
            ->get()
            ->map(fn ($el) => unserialize($el->serialized))
            ->toArray();
    }

    public function saveFor(string $id, array $events): void
    {
        $eventsData = array_map(fn (AggregateRootEvent $e) => [
            'entity_id' => $id,
            'type' => $e::class,
            'serialized' => serialize($e)
        ], $events);
        EventModel::insert($eventsData);
    }
}
