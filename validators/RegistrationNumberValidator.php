<?php
namespace app\validators;
class RegistrationNumberValidator implements FieldValidatorInterface
{
    public function validate($value): bool
    {
        return preg_match('/^[0-9]+$/', $value);
    }

    public function getErrorMessage(): string
    {
        return 'Apenas números são permitidos.';
    }
}