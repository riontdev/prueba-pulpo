<?php
declare(strict_types = 1);

namespace Src\OutSourcing\User\Application\UseCases\Queries;

use Src\Common\Domain\QueryInterface;
use Src\OutSourcing\User\Domain\Policies\UserPolicy;
use Src\OutSourcing\User\Domain\Repositories\UserRepositoryInterface;

final class FindAllUsersQuery implements QueryInterface
{
    private UserRepositoryInterface $repository;

    public function __construct(
      
    )
    {
        $this->repository = app()->make(UserRepositoryInterface::class);
    }

    public function handle(): array
    {
        return $this->repository->findAll();
    }
}