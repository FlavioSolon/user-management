<?php
namespace app\validators;
class EmailValidator implements FieldValidatorInterface
{
    public function validate($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function getErrorMessage(): string
    {
        return 'Email inválido.';
    }
}