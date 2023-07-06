<?php

namespace App\SharedKernel\Domain\ValueObjects;

interface ValueObject
{
    public function equalsTo(ValueObject $another): bool;

    public function __toString(): string;
}
