<?php
namespace app\validators;

interface FieldValidatorInterface
{
    public function validate($value): bool;
    public function getErrorMessage(): string;
}