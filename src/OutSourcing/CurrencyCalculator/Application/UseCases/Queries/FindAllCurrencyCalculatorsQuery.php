<?php

namespace Src\OutSourcing\CurrencyCalculator\Application\UseCases\Queries;

use Src\Common\Domain\QueryInterface;
use Src\Common\Infrastructure\Integration\Contracts\CurrencyInterface;
use Src\OutSourcing\CurrencyCalculator\Domain\Repositories\RequestTemporalRepositoryInterface;

final class FindAllCurrencyCalculatorsQuery implements QueryInterface
{

    private CurrencyInterface $service_currency;
    private RequestTemporalRepositoryInterface $temporal_request_repository;
    public function __construct(
    )
    {
        $this->service_currency = app()->make(CurrencyInterface::class);
        $this->temporal_request_repository = app()->make(RequestTemporalRepositoryInterface::class);

    }

    public function handle(): array
    {
        $data = [];
        $response = $this->service_currency->getAllCurrency();
        if ($response->status() >= 200 && $response->status() < 300) {
            $data = $response->json()['currencies'];
        }
        return $data;
    }
}