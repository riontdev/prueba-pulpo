<?php

namespace Src\OutSourcing\CurrencyCalculator\Application\Mappers;

use Illuminate\Http\Request;
use Src\OutSourcing\CurrencyCalculator\Domain\Model\Currency;
use Src\OutSourcing\CurrencyCalculator\Domain\Model\ValueObjects\Name;
use Src\OutSourcing\CurrencyCalculator\Domain\Model\ValueObjects\ShortName;

final class CurrencyCalculatorMapper
{
    public static function fromRequest(Request $request): Currency
    {
        return new Currency(
            short_name: new ShortName($request->short_name),
            name: new Name($request->name),
        );
    }

}