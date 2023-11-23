<?php

namespace Src\OutSourcing\User\Presentation\HTTP;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Common\Domain\Exceptions\UnauthorizedUserException;
use Src\OutSourcing\User\Application\Mappers\UserMapper;
use Src\OutSourcing\User\Application\UseCases\Commands\DeleteUserCommand;
use Src\Outsourcing\User\Application\UseCases\Commands\SaveUserCommand;
use Src\OutSourcing\User\Application\UseCases\Commands\UpdateUserCommand;
use Src\OutSourcing\User\Application\UseCases\Queries\FindAllUsersQuery;
use Src\OutSourcing\User\Application\UseCases\Queries\FindUserByIdQuery;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    public function index(): JsonResponse
    {
        try {
            return response()->success((new FindAllUsersQuery())->handle());
        } catch (UnauthorizedUserException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return response()->json((new FindUserByIdQuery($id))->handle());
        } catch (UnauthorizedUserException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $user = UserMapper::fromRequest($request);
            $userData = (new SaveUserCommand($user, $request->password, $request->confirmed_password))->execute();
            return response()->json($userData, Response::HTTP_CREATED);
        } catch (\DomainException $domainException) {
            return response()->json(['error' => $domainException->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (UnauthorizedUserException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $user = UserMapper::fromRequest($request, $id);
            (new UpdateUserCommand($user,$request->password, $request->confirmed_password))->execute();
            return response()->json($user, Response::HTTP_OK);
        } catch (\DomainException $domainException) {
            return response()->json(['error' => $domainException->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (UnauthorizedUserException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            (new DeleteUserCommand($id))->execute();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (UnauthorizedUserException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

}