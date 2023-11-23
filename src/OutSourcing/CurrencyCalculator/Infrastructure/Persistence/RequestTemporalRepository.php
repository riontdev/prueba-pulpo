<?php

namespace Src\OutSourcing\CurrencyCalculator\Infrastructure\Persistence;
use Src\OutSourcing\CurrencyCalculator\Domain\Model\CurrencyCalculator;
use Src\OutSourcing\CurrencyCalculator\Domain\Repositories\RequestTemporalRepositoryInterface;
use Src\OutSourcing\CurrencyCalculator\Infrastructure\Persistence\Eloquent\RequestTemporalEloquentModel;


final class RequestTemporalRepository implements RequestTemporalRepositoryInterface
{
   
    public function checkLimit(string $ip): array
    {
        $count = RequestTemporalEloquentModel::query()->where('ip', $ip)->count();
        return [
            "count" => $count
        ];
    }

    public function store(CurrencyCalculator $currency_calculator): void
    {
        $this->toEloquent($currency_calculator);
    }

    private function toEloquent(CurrencyCalculator $currency_calculator) {
        $userEloquent = new RequestTemporalEloquentModel();
        if ($currency_calculator->id) {
            $userEloquent = RequestTemporalEloquentModel::query()->findOrFail($currency_calculator->id);
        }
        $userEloquent->to_currency = $currency_calculator->to_currency->short_name;
        $userEloquent->from_currency = $currency_calculator->from_currency->short_name;
        $userEloquent->amount = $currency_calculator->amount;
        $userEloquent->ip = $currency_calculator->ip;
        $userEloquent->save();

        return $userEloquent;
    }
}
