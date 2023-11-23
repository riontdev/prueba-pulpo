<?php

namespace Src\OutSourcing\CurrencyCalculator\Application\Providers;


use Illuminate\Support\ServiceProvider;

class CurrencyCalculatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \Src\OutSourcing\CurrencyCalculator\Domain\Repositories\RequestTemporalRepositoryInterface::class,
            \Src\OutSourcing\CurrencyCalculator\Infrastructure\Persistence\RequestTemporalRepository::class
        );
    }
}