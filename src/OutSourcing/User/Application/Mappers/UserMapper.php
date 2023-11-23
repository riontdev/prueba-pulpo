<?php

namespace Src\OutSourcing\User\Application\Mappers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Src\OutSourcing\User\Domain\Model\User;
use Src\OutSourcing\User\Domain\Model\ValueObjects\Email;
use Src\OutSourcing\User\Domain\Model\ValueObjects\Name;
use Src\OutSourcing\User\Infrastructure\Persistence\Eloquent\UserEloquentModel;

class UserMapper
{
    public static function fromRequest(Request $request, ?int $user_id = null): User
    {
        return new User(
            id: $user_id,
            name: new Name($request->name),
            email: new Email($request->email),
        );
    }

    public static function fromEloquent(UserEloquentModel $userEloquent): User
    {
        return new User(
            id: $userEloquent->id,
            name: new Name($userEloquent->name),
            email: new Email($userEloquent->email)
        );
    }

    public static function fromAuth(Authenticatable $userEloquent): User
    {
        return new User(
            id: $userEloquent->id,
            name: new Name($userEloquent->name),
            email: new Email($userEloquent->email)
        );
    }

}