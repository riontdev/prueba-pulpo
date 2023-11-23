<?php

namespace Src\OutSourcing\CurrencyCalculator\Domain\Repositories;

use Src\OutSourcing\CurrencyCalculator\Domain\Model\CurrencyCalculator;
use Src\OutSourcing\User\Domain\Model\ValueObjects\Password;

interface RequestTemporalRepositoryInterface
{
    public function checkLimit(string $ip): array;

    public function store(CurrencyCalculator $currency_calculator): void;

}
