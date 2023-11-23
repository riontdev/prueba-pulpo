<?php

namespace Src\OutSourcing\CurrencyCalculator\Application\UseCases\Commands;

use Src\Common\Domain\CommandInterface;
use Src\Common\Infrastructure\Integration\Contracts\CurrencyInterface;
use Src\OutSourcing\CurrencyCalculator\Application\Exceptions\ApiErrorException;
use Src\OutSourcing\CurrencyCalculator\Application\Exceptions\ApiErrorLimitException;
use Src\OutSourcing\CurrencyCalculator\Domain\Model\CurrencyCalculator;
use Src\OutSourcing\CurrencyCalculator\Domain\Policies\CurrencyCalculatorPolicy;
use Src\OutSourcing\CurrencyCalculator\Domain\Repositories\CurrencyCalculatorRepositoryInterface;
use Src\OutSourcing\CurrencyCalculator\Domain\Repositories\RequestTemporalRepositoryInterface;

final class StoreCurrencyCalculatorCommand implements CommandInterface
{
    private CurrencyInterface $service_currency;
    private RequestTemporalRepositoryInterface $temporal_request_repository;
    public function __construct(
        private readonly CurrencyCalculator $currency_calculator,
        private readonly bool $is_anonymus
    )
    {
        $this->service_currency = app()->make(CurrencyInterface::class);
        $this->temporal_request_repository = app()->make(RequestTemporalRepositoryInterface::class);
    }

    public function execute(): array
    {
        $data = [];
        if ($this->is_anonymus) {
            $data_temporal_request = $this->temporal_request_repository->checkLimit($this->currency_calculator->ip);
            if ($data_temporal_request['count'] > 3) {
                throw new ApiErrorLimitException();
            }
        }

        $response = $this->service_currency->convertCurrency(
            $this->currency_calculator->from_currency->short_name,
            $this->currency_calculator->to_currency->short_name,
            $this->currency_calculator->amount
        );

        
        if ($response->status() >= 200 && $response->status() < 300) {
            $data = $response->json()['result'];
            $this->temporal_request_repository->store($this->currency_calculator);
        } else {
            throw new ApiErrorException();
        }

        return [
            "amount" => $data,
            "currency" => $this->currency_calculator->to_currency->short_name
        ];
    }
}