<?php

namespace Src\OutSourcing\CurrencyCalculator\Application\Mappers;

use Illuminate\Http\Request;
use Src\OutSourcing\CurrencyCalculator\Domain\Model\Currency;
use Src\OutSourcing\CurrencyCalculator\Domain\Model\CurrencyCalculator;
use Src\OutSourcing\CurrencyCalculator\Domain\Model\ValueObjects\Name;
use Src\OutSourcing\CurrencyCalculator\Domain\Model\ValueObjects\ShortName;
class CurrencyCalculatorMapper
{
    public static function fromRequest(Request $request, ?string $ip = null, ?int $currency_id = null): CurrencyCalculator
    {
        return new CurrencyCalculator(
            id: $currency_id,
            ip: $ip,
            from_currency: new Currency( 
                short_name: new ShortName($request->from_currency),
                name: new Name($request->from_currency)
            ),
            to_currency: new Currency(
                short_name: new ShortName($request->to_currency),
                name: new Name($request->to_currency)
            ),
            amount: $request->amount
        );
    }

}