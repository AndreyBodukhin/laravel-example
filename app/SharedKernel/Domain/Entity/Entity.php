<?php

namespace App\SharedKernel\Domain\Entity;

/**
 * @template T
 */
interface Entity
{
    /**
     * @return T
     */
    public function getId();
}
