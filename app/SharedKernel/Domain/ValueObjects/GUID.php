<?php

namespace App\SharedKernel\Domain\ValueObjects;

/**
 * @extends BaseValueObject<string>
 */
final class GUID extends BaseValueObject
{
    public static function next(): GUID
    {
        return new GUID(uniqid());
    }

    protected function validate($value)
    {
        $value = trim($value);
        if (empty($value)) {
            throw new \InvalidArgumentException('Invalid GUID value!');
        }
        return $value;
    }
}
