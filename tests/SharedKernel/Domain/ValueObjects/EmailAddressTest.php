<?php

namespace Tests\SharedKernel\Domain\ValueObjects;

use App\SharedKernel\Domain\ValueObjects\EmailAddress;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmailAddressTest extends TestCase
{
    private const VALID_EMAIL = 'test@test.ru';
    private const INVALID_EMAIL = 'test@test';

    public function test_create_for_valid_email()
    {
        $email = EmailAddress::create(self::VALID_EMAIL);
        $this->assertEquals(self::VALID_EMAIL, $email->value());
    }

    public function test_create_for_invalid_email()
    {
        $this->expectException(InvalidArgumentException::class);
        EmailAddress::create(self::INVALID_EMAIL);
    }

    public function test_create_for_empty_email()
    {
        $this->expectException(InvalidArgumentException::class);
        EmailAddress::create('');
    }
}
