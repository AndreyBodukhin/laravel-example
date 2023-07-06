<?php

namespace App\SharedKernel\Domain\Services;

use App\SharedKernel\Domain\ValueObjects\GUID;

interface GuidGenerator
{
    public function next(): GUID;
}
