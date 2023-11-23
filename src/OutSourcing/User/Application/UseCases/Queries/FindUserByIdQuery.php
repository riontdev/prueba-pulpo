<?php
declare(strict_types = 1);

namespace Src\OutSourcing\User\Application\UseCases\Queries;

use Src\Common\Domain\QueryInterface;
use Src\OutSourcing\User\Domain\Model\User;
use Src\OutSourcing\User\Domain\Policies\UserPolicy;
use Src\OutSourcing\User\Domain\Repositories\UserRepositoryInterface;

final class FindUserByIdQuery implements QueryInterface
{
    private UserRepositoryInterface $repository;

    public function __construct(
        private readonly int $id,
    )
    {
        $this->repository = app()->make(UserRepositoryInterface::class);
    }

    public function handle(): User
    {
        authorize('findUserById', UserPolicy::class);
        return $this->repository->findById($this->id);
    }
}