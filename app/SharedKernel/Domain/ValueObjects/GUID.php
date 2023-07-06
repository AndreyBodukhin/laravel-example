<?php

namespace App\SharedKernel\Domain\ValueObjects;

/**
 * @extends BaseValueObject<string>
 */
final class GUID extends BaseValueObject
{
    protected function validate($value)
    {
        $value = trim($value);
        if (empty($value)) {
            throw new \InvalidArgumentException('Invalid GUID value!');
        }
        return $value;
    }
}
