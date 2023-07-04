<?php

namespace App\SharedKernel\Domain\ValueObjects;

interface ValueObject
{
    public function equalsTo(ValueObject $another): bool;
}
