<?php

namespace Src\OutSourcing\User\Domain\Exceptions;

final class PasswordTooShortException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('The password needs to be at least 8 characters long');
    }
}