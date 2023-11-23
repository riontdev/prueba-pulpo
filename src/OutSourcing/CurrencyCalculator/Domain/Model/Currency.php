<?php

namespace Src\OutSourcing\CurrencyCalculator\Domain\Model;

use Src\Common\Domain\AggregateRoot;
use Src\OutSourcing\CurrencyCalculator\Domain\Model\ValueObjects\Name;
use Src\OutSourcing\CurrencyCalculator\Domain\Model\ValueObjects\ShortName;

final class Currency extends AggregateRoot implements \JsonSerializable
{
    public function __construct(
        public readonly ShortName $short_name,
        public readonly ?Name $name,
    )
    {}

    public function toArray(): array
    {
        return [
            "short_name" => $this->short_name,
            "name" => $this->name,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}