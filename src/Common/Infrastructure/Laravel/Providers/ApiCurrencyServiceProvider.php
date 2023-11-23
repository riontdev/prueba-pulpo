<?php

namespace Src\Common\Infrastructure\Laravel\Providers;


use Illuminate\Support\ServiceProvider;

class ApiCurrencyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \Src\Common\Infrastructure\Integration\Contracts\CurrencyInterface::class,
            \Src\Common\Infrastructure\Integration\CurrencyService::class,
        );
    }
}