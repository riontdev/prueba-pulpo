<?php

declare(strict_types=1);

namespace Src\OutSourcing\CurrencyCalculator\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;
use Src\OutSourcing\CurrencyCalculator\Domain\Exceptions\ShortNameTooLargeException;

final class ShortName extends ValueObject
{
    private string $value;

    public function __construct(?string $short_name)
    {

        if (!$short_name) {
            throw new RequiredException('short name for currency');
        }

        if (strlen($short_name) > 3 ) {
            throw new ShortNameTooLargeException();
        }

        $this->value = $short_name;
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