<?php

namespace App\Providers;

use App\SharedKernel\Infrastructure\Repositories\EloquentEventStore;
use App\SharedKernel\Infrastructure\Repositories\EventStore;
use App\User\Domain\Repositories\UserRepository;
use App\User\Infrastructure\Domain\Repositories\EventSourcingUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EventStore::class, EloquentEventStore::class);
        $this->app->singleton(
            UserRepository::class,
            fn($app) => new EventSourcingUserRepository(
                $app->make(EventStore::class)
            )
        );
    }

    public function boot(): void
    {
        //
    }
}
