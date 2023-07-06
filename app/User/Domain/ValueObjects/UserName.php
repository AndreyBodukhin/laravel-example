<?php

namespace App\User\Domain\ValueObjects;

use App\SharedKernel\Domain\ValueObjects\BaseValueObject;
use InvalidArgumentException;

/**
 * @extends BaseValueObject<string>
 */
final class UserName extends BaseValueObject
{
    protected function validate($value)
    {
        $value = trim($value);
        if (empty($value)) {
            throw new InvalidArgumentException('Empty user name!');
        }
        return $value;
    }
}
