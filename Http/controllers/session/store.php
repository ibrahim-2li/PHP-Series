<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

// login if user credentials is match

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    $auth = new Authenticator();
    if ($auth->attempt($email, $password)) {
        redirect('/');
    }
    $form->error('email', 'No matching account found !!');
}


Session::flash('errors', $form->errors());

return redirect('/login');
