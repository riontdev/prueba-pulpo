<?php

declare(strict_types=1);

namespace Src\OutSourcing\User\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class Email extends ValueObject
{
    private string $value;

    public function __construct(?string $email)
    {

        if (!$email) {
            throw new RequiredException('email');
        }

        $this->value = $email;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}