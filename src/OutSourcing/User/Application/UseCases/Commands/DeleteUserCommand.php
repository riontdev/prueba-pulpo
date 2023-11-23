<?php
declare(strict_types = 1);

namespace Src\OutSourcing\User\Application\UseCases\Commands;

use Src\Common\Domain\CommandInterface;
use Src\OutSourcing\User\Domain\Policies\UserPolicy;
use Src\OutSourcing\User\Domain\Repositories\UserRepositoryInterface;

final class DeleteUserCommand implements CommandInterface
{
    private UserRepositoryInterface $repository;

    public function __construct(
        private readonly int $id
    )
    {
        $this->repository = app()->make(UserRepositoryInterface::class);
    }

    public function execute(): void
    {
        authorize('delete', UserPolicy::class);
        $this->repository->delete($this->id);
    }
}