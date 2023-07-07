<?php

namespace App\SharedKernel\Domain\Entity;

use App\SharedKernel\Domain\Events\AggregateRootEvent;

abstract class AggregateRootWithEvents implements AggregateRoot
{
    private array $records = [];

    public static function wakeUp($events): AggregateRootWithEvents
    {
        $entity = (new static())
            ->apply(...$events);
        static::popEvents($entity);
        return $entity;
    }

    /**
     * @return AggregateRootEvent[]
     */
    public static function popEvents(AggregateRootWithEvents $entity): array
    {
        $records = $entity->records;
        $entity->records = [];
        return $records;
    }

    protected function apply(AggregateRootEvent ...$events): static
    {
        foreach ($events as $event) {
            $this->{$this->getApplyMethodName($event)}($event);
            $this->recordThat($event);
        }
        return $this;
    }

    /**
     * @return AggregateRootEvent[]
     */
    protected function getEvents(): array
    {
        return $this->records;
    }

    private function recordThat(AggregateRootEvent $event): void
    {
        $this->records[] = $event;
    }

    protected function getApplyMethodName(AggregateRootEvent $event): string
    {
        preg_match("/(?<class_name>\w+$)/", get_class($event), $matches);
        $eventClassName = $matches['class_name'];
        return "apply{$eventClassName}";
    }
}
