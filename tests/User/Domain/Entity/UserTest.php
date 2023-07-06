<?php

namespace Tests\User\Domain\Entity;

use App\SharedKernel\Domain\ValueObjects\EmailAddress;
use App\SharedKernel\Domain\ValueObjects\GUID;
use App\User\Domain\Entity\User;
use App\User\Domain\ValueObjects\UserName;
use App\User\Domain\ValueObjects\UserPassword;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private const USER_NAME = 'Test User Name';
    private const USER_EMAIL = 'test@test.ru';
    private const USER_GUID = 'test_guid';
    private User $user;

    protected function setUp(): void
    {
        $this->user = User::register(
            GUID::create(self::USER_GUID),
            UserName::create(self::USER_NAME),
            EmailAddress::create(self::USER_EMAIL),
            UserPassword::create('password')
        );
    }

    public function test_user_register()
    {
        $this->assertEquals(self::USER_GUID, $this->user->getId()->value(), 'Invalid Id');
        $this->assertEquals(self::USER_NAME, $this->user->getName()->value(), 'Invalid name');
        $this->assertEquals(self::USER_EMAIL, $this->user->getEmail()->value(), 'Invalid Email');

        $this->assertFalse($this->user->getEmail()->isVerified(), 'Email is verified');
        $this->assertFalse($this->user->isActive(), 'User is active');
        $this->assertFalse($this->user->isVerified(), 'User is verified');
        $this->assertFalse($this->user->isBaned(), 'User is Banned');
    }

    public function test_email_verify()
    {
        $this->assertFalse($this->user->isVerified());

        $this->user->verifyEmail();

        $this->assertTrue($this->user->isVerified());
    }

    public function test_user_ban()
    {
        $this->assertFalse($this->user->isBaned());

        $this->user->ban('Test ban');

        $this->assertTrue($this->user->isBaned());
    }

    public function test_user_unban()
    {
        $this->user->ban('');

        $this->assertTrue($this->user->isBaned());

        $this->user->unban();

        $this->assertFalse($this->user->isBaned());
    }

    public function test_user_active()
    {
        $this->assertFalse($this->user->isActive());

        $this->user->verifyEmail();

        $this->assertTrue($this->user->isActive());

        $this->user->ban('');

        $this->assertFalse($this->user->isActive());
    }
}
