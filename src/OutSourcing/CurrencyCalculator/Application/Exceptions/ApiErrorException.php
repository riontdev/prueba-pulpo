<?php

namespace Src\OutSourcing\CurrencyCalculator\Application\Exceptions;

final class ApiErrorException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('api error try later');
    }
}