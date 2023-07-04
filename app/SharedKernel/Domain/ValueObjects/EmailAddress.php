<?php

namespace App\SharedKernel\Domain\ValueObjects;

use InvalidArgumentException;

/**
 * @extends BaseValueObject<string>
 */
final class EmailAddress extends BaseValueObject
{
    protected function validate($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email!');
        }
        return $value;
    }
}
