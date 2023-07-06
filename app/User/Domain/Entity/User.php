<?php

namespace App\User\Domain\Entity;

use App\SharedKernel\Domain\Entity\AggregateRootWithEvents;
use App\SharedKernel\Domain\ValueObjects\EmailAddress;
use App\SharedKernel\Domain\ValueObjects\GUID;
use App\User\Domain\Events\UserVerifiedEmail;
use App\User\Domain\Events\UserWasBanned;
use App\User\Domain\Events\UserWasRegistered;
use App\User\Domain\Events\UserWasUnbanned;
use App\User\Domain\ValueObjects\UserEmail;
use App\User\Domain\ValueObjects\UserName;
use App\User\Domain\ValueObjects\UserPassword;

final class User extends AggregateRootWithEvents
{
    private GUID $id;
    private UserName $name;
    private UserEmail $email;
    private UserPassword $password;

    private bool $isBaned = false;

    public static function register(
        GUID         $guid,
        UserName     $userName,
        EmailAddress $email,
        UserPassword $password
    ): User
    {
        $userEmail = UserEmail::createUnverified($email);
        return (new self())
            ->apply(
                new UserWasRegistered($guid, $userName, $userEmail, $password)
            );
    }

    public function verifyEmail()
    {
        $this->apply(new UserVerifiedEmail());
    }

    public function ban(string $reason)
    {
        $this->apply(new UserWasBanned($reason));
    }

    public function unban()
    {
        $this->apply(new UserWasUnbanned());
    }

    public function getId(): GUID
    {
        return $this->id;
    }

    public function getName(): UserName
    {
        return $this->name;
    }

    public function getEmail(): UserEmail
    {
        return $this->email;
    }

    public function getPassword(): UserPassword
    {
        return $this->password;
    }

    public function isActive(): bool
    {
        return $this->isVerified() && !$this->isBaned;
    }

    public function isVerified(): bool
    {
        return $this->email->isVerified();
    }

    public function isBaned(): bool
    {
        return $this->isBaned;
    }

    protected function applyUserWasRegistered(UserWasRegistered $event): void
    {
        $this->id = $event->id;
        $this->email = $event->email;
        $this->name = $event->name;
        $this->password = $event->password;
    }

    protected function applyUserVerifiedEmail(UserVerifiedEmail $event)
    {
        $this->email = UserEmail::createVerified($this->email->getEmail());
    }

    protected function applyUserWasBanned(UserWasBanned $event)
    {
        $this->isBaned = true;
    }

    protected function applyUserWasUnbanned()
    {
        $this->isBaned = false;
    }
}
