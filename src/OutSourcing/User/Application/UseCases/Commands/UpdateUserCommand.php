<?php
declare(strict_types = 1);

namespace Src\OutSourcing\User\Application\UseCases\Commands;

use Src\Common\Domain\CommandInterface;
use Src\OutSourcing\User\Domain\Model\User;
use Src\OutSourcing\User\Domain\Model\ValueObjects\Password;
use Src\OutSourcing\User\Domain\Policies\UserPolicy;
use Src\OutSourcing\User\Domain\Repositories\UserRepositoryInterface;

final class UpdateUserCommand implements CommandInterface
{
    private UserRepositoryInterface $repository;

    public function __construct(
        private readonly User $user,
        private readonly string $password,
        private readonly string $confirmed_password
    )
    {
        $this->repository = app()->make(UserRepositoryInterface::class);
        $this->password = $password;
        $this->confirmed_password = $confirmed_password;
    }

    public function execute(): void
    {
        $password = new Password($this->password, $this->confirmed_password);
        $this->repository->update($this->user,$password);
    }
}