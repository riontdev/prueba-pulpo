<?php
declare(strict_types = 1);

namespace Src\OutSourcing\User\Application\UseCases\Commands;

use Src\Common\Domain\CommandInterface;
use Src\OutSourcing\User\Domain\Model\User;
use Src\OutSourcing\User\Domain\Model\ValueObjects\Password;
use Src\OutSourcing\User\Domain\Policies\UserPolicy;
use Src\OutSourcing\User\Domain\Repositories\UserRepositoryInterface;

final class SaveUserCommand implements CommandInterface
{
    private UserRepositoryInterface $repository;

    public function __construct(
        private readonly User $user,
        private readonly string $password,
        private readonly ?string $confirmed_password
    )
    {
        $this->repository = app()->make(UserRepositoryInterface::class);
    }

    public function execute(): mixed
    {
        $password = new Password($this->password, $this->confirmed_password);
        return $this->repository->store($this->user, $password);
    }
}