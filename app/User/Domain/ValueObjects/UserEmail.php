<?php

namespace App\User\Domain\ValueObjects;

use App\SharedKernel\Domain\ValueObjects\EmailAddress;
use App\SharedKernel\Domain\ValueObjects\ValueObject;

final class UserEmail implements ValueObject
{
    private EmailAddress $email;
    private bool $isVerified;
    private function __construct(EmailAddress $email, bool $isVerified)
    {
        $this->email = $email;
        $this->isVerified = $isVerified;
    }

    public static function createVerified(EmailAddress $email): UserEmail
    {
        return new self($email, true);
    }

    public static function createUnverified(EmailAddress $email): UserEmail
    {
        return new self($email, false);
    }

    public function value(): string
    {
        return $this->email->value();
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }


    public function equalsTo(ValueObject $another): bool
    {
        if (get_class($this) !== get_class($another)) {
            return false;
        }

        /** @var UserEmail $another */
        return $this->isVerified === $another->isVerified && $this->email->equalsTo($another->getEmail());
    }

    public function __toString(): string
    {
        return "{$this->value()} | " . ($this->isVerified() ? 'Verified' : 'Unverified');
    }
}
