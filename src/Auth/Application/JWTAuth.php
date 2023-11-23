<?php

namespace Src\Auth\Application;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Log;
use Src\OutSourcing\User\Application\Mappers\UserMapper;
use Src\OutSourcing\User\Domain\Model\User;
use Src\OutSourcing\User\Infrastructure\Persistence\Eloquent\UserEloquentModel;
use Src\Auth\Domain\AuthInterface;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth as TymonJWTAuth;

class JWTAuth implements AuthInterface
{

    public function __construct()
    {
    }

    public function login(array $credentials): string
    {
        $user = UserEloquentModel::query()->where('email', $credentials['email'])->first();
        if (!$user) {
            throw new AuthenticationException();
        } elseif (!$token = TymonJWTAuth::attempt($credentials)) {
            throw new AuthenticationException();
        }
        return $token;
    }

    public function logout(): void
    {
        auth()->logout();
    }

    public function me(): User
    {
        return UserMapper::fromAuth(auth()->user());
    }

    public function refresh(): string
    {
        try {
            return TymonJWTAuth::parseToken()->refresh();
        } catch (JWTException $e) {
            Log::error($e->getMessage());
            throw new AuthenticationException($e->getMessage());
        }
    }
}