<?php

namespace App\SharedKernel\Domain\Entity;

use App\SharedKernel\Domain\Events\AggregateRootEvent;

abstract class AggregateRootWithEvents implements AggregateRoot
{
    protected array $records = [];

    abstract protected function apply(AggregateRootEvent $event);

    protected function recordThat(AggregateRootEvent $event)
    {
        $this->records[] = $event;
    }
}
