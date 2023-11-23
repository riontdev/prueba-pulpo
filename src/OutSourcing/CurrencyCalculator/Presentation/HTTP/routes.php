<?php

use Illuminate\Support\Facades\Route;
use Src\OutSourcing\CurrencyCalculator\Presentation\HTTP\CurrencyCalculatorController;

Route::group([
    'prefix' => 'currency_calculator'
], function () {
    Route::get('', [CurrencyCalculatorController::class, 'index']);
    Route::post('', [CurrencyCalculatorController::class, 'store']);
});
