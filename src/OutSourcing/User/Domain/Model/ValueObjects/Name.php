<?php

declare(strict_types=1);

namespace Src\OutSourcing\User\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class Name extends ValueObject
{
    private string $value;

    public function __construct(?string $name)
    {

        if (!$name) {
            throw new RequiredException('name');
        }

        $this->value = $name;
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