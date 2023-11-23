<?php

namespace Src\OutSourcing\User\Domain\Repositories;

use Src\OutSourcing\User\Domain\Model\User;
use Src\OutSourcing\User\Domain\Model\ValueObjects\Password;

interface UserRepositoryInterface
{
    public function findAll(): array;

    public function findById(string $userId): User;

    public function findByUserName(string $username): User;

    public function store(User $user, Password $password): User;

    public function update(User $user, Password $password): void;

    public function delete(int $user_id): void;

}
