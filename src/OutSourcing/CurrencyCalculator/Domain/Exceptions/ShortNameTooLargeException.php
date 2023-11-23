<?php

namespace Src\OutSourcing\CurrencyCalculator\Domain\Exceptions;

final class ShortNameTooLargeException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('The short name needs to be at least 3 characters');
    }
}