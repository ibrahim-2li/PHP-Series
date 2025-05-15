<?php

namespace Core;

class ValidationException extends \Exception
{
    public readonly array $errors;
    public readonly array $old;
    
    public static function throw($errors, $old)
    {
        $instence = new static;

        $instence->errors = $errors;
        $instence->old = $old;

        throw $instence;
    }
   
}