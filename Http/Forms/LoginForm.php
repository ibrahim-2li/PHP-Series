<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected $errors = [];
    public function validate($email, $password)
    {

        if (! Validator::email($email)) {
            $this->errors['email'] = "A valied email is erquired";
        }
        if (! Validator::string($password)) {
            $this->errors['password'] = "A valied password is erquired";
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($filed, $message)
    {
        $this->errors[$filed] = $message;
    }
}
