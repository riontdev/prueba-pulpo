<?php

namespace Src\OutSourcing\CurrencyCalculator\Domain\Model;

use Src\Common\Domain\AggregateRoot;

final class CurrencyCalculator extends AggregateRoot implements \JsonSerializable
{
    public function __construct(
        public readonly ?string $id,
        public readonly ?string $ip,
        public readonly Currency $from_currency,
        public readonly Currency $to_currency,
        public readonly float $amount,
    )
    {}

    public function toArray(): array
    {
        return [
           "id" => $this->id,
           "ip" => $this->ip,
           "from_currency" => $this->from_currency,
           "to_currency" => $this->to_currency,
           "amount" => $this->amount
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}