<?php

namespace Src\Common\Infrastructure\Integration;

use Illuminate\Support\Facades\Http;
use Src\Common\Infrastructure\Integration\Contracts\CurrencyInterface;
use Illuminate\Http\Client\Response;
final class CurrencyService implements CurrencyInterface
{
    private string $url;
    private string $token;

    public function __construct()
    {
        $this->token = config('currency.CURRENCY_API_TOKEN');
        $this->url = config('currency.CURRENCY_API_URL');
    }

    public function getAllCurrency() : Response
    {
        //TODO: para ahorrar consultas  o mejorar tiempo de respuestas en las llamadas seria mejor guardar la info Ej: una tabla, cache , entre otros...
        return Http::get($this->url . "/list?access_key={$this->token}");
    }

    public function convertCurrency(string $from, string $to, float $amount) : Response
    {
       return Http::post($this->url . "/convert?access_key={$this->token}&from={$from}&to={$to}&amount={$amount}");
    }
}
