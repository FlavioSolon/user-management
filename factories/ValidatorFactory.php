<?php
namespace app\factories;

use app\validators\EmailValidator;
use app\validators\NameValidator;
use app\validators\RegistrationNumberValidator;
use InvalidArgumentException;

class ValidatorFactory
{
    public static function create(string $type): object
    {
        switch ($type) {
            case 'name':
                return new NameValidator();
            case 'email':
                return new EmailValidator();
            case 'registration_number':
                return new RegistrationNumberValidator();
            default:
                throw new InvalidArgumentException("Validador inválido: $type");
        }
    }
}