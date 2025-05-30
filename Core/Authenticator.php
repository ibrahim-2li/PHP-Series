<?php

namespace Core;

use Core\App;
use Core\Session;
use Core\Database;

class Authenticator
{
    public function register($email, $password)
    {
        $user = App::resolve(Database::class)->query('select * from users where email = :email ', [
            'email' => $email
        ])->find();

        if ($user) {
            return true;
        }
        return false;
    }

    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query("select * from users where email = :email", [
            'email' => $email,
        ])->find();

        if ($user) {

            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email
                ]);

                return true;
            }
        }
        return false;
    }

    public function login($user)
    {

        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {

        Session::destroy();
    }
}
