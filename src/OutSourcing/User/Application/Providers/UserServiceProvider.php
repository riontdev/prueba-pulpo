<?php

namespace Src\OutSourcing\User\Application\Providers;


use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \Src\OutSourcing\User\Domain\Repositories\UserRepositoryInterface::class,
            \Src\OutSourcing\User\Infrastructure\Persistence\UserRepository::class
        );
    }
}