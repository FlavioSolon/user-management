<?php
namespace app\validators;

class NameValidator implements FieldValidatorInterface
{
    public function validate($value): bool
    {
        return preg_match('/^[a-zA-Z\s]+$/', $value);
    }

    public function getErrorMessage(): string
    {
        return 'Apenas letras são permitidas.';
    }
}