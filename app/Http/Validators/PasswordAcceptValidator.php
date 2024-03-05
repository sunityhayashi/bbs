<?php
namespace App\Http\Validators;

use Illuminate\Validation\Validator;

class PasswordAcceptValidator extends Validator
{
    public function validatePasswordAccept($attribute, $value, $parameters)
    {
        return password_verify($value, $parameters[0]);
    }
}