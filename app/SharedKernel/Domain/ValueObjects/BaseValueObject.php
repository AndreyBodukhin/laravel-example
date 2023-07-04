<?php

namespace App\SharedKernel\Domain\ValueObjects;

use InvalidArgumentException;

/**
 * @template T
 * @phpstan-consistent-constructor
 */
abstract class BaseValueObject implements ValueObject
{
    /**
     * @var T
     */
    protected $value;

    /**
     * @param T $value
     */
    protected function __construct($value)
    {
        $this->value = $this->validate($value);
    }

    /**
     * @param T $value
     *
     * @return static
     */
    public static function create($value): static
    {
        return new static($value);
    }

    /**
     * @return T
     */
    public function value()
    {
        return $this->value;
    }

    public function equalsTo(ValueObject $another): bool
    {
        if (get_class($this) !== get_class($another)) {
            return false;
        }
        /** @var BaseValueObject $another */
        return $this->value() === $another->value();
    }

    public function __toString(): string
    {
        return (string)$this->value();
    }

    /**
     * @param T $value
     *
     * @throws InvalidArgumentException
     *
     * @return T
     */
    protected function validate($value)
    {
        return $value;
    }
}
