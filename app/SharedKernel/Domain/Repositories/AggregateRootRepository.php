<?php

namespace App\SharedKernel\Domain\Repositories;

use App\SharedKernel\Domain\Entity\AggregateRoot;

interface AggregateRootRepository
{
    public function get(string $id);

    public function save(AggregateRoot $entity): void;
}
