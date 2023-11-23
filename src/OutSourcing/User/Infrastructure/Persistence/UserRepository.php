<?php

namespace Src\OutSourcing\User\Infrastructure\Persistence;

use Exception;
use Src\OutSourcing\User\Application\Mappers\UserMapper;
use Src\OutSourcing\User\Domain\Model\User;
use Src\OutSourcing\User\Domain\Model\ValueObjects\Password;
use Src\OutSourcing\User\Domain\Repositories\UserRepositoryInterface;
use Src\OutSourcing\User\Infrastructure\Persistence\Eloquent\UserEloquentModel;
use Illuminate\Http\Request;

final class UserRepository implements UserRepositoryInterface
{
    public function findAll(): array
    {
        $users = [];
        foreach (UserEloquentModel::all() as $userEloquent) {
            $users[] = UserMapper::fromEloquent($userEloquent);
        }
        return $users;
    }

    private function toEloquent(User $user) {
        $userEloquent = new UserEloquentModel();
        if ($user->id) {
            $userEloquent = UserEloquentModel::query()->findOrFail($user->id);
        }
        $userEloquent->name = $user->name;
        $userEloquent->email = $user->email;

        return $userEloquent;
    }
    

    public function findById(string $userId): User
    {
        $userEloquent = UserEloquentModel::query()->findOrFail($userId);
        return UserMapper::fromEloquent($userEloquent);
    }

    public function findByUserName(string $username): User
    {
        $userEloquent = UserEloquentModel::query()->where('username', $username)->firstOrFail();
        return UserMapper::fromEloquent($userEloquent);
    }

    public function store(User $user, Password $password): User
    {
        
        $userEloquent = $this->toEloquent($user);
        $userEloquent->password = $password->value;
        $userEloquent->save();

        return UserMapper::fromEloquent($userEloquent);
    }

    public function update(User $user, Password $password): void
    {
        $userEloquent = $this->toEloquent($user);
        if ($password->isNotEmpty()) {
            $userEloquent->password = $password->value;
        }
        $userEloquent->save();
    }

    public function delete(int $user_id): void
    {
        $userEloquent = UserEloquentModel::query()->findOrFail($user_id);
        $userEloquent->delete();
    }
}