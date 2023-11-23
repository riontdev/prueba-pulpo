<?php

namespace Src\Common\Infrastructure\Integration\Contracts;
use Illuminate\Http\Client\Response;
//TODO: posiblemente cambie a clase abstracta para efectos de uso de distintas tipo de API
interface CurrencyInterface
{
    public function getAllCurrency() : Response;

    public function convertCurrency(string $from, string $to, float $amount) : Response;
}
