<?php

namespace Src\OutSourcing\CurrencyCalculator\Application\Exceptions;

final class ApiErrorLimitException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('limit request out');
    }
}