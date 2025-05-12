<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
$auth = new Authenticator;

if ($form->validate($email, $password)) {
    if (! $auth->register($email, $password)) {
        $db->query('INSERT INTO users (email, password) VALUE(:email, :password)', [
        'email'     => $email,
        'password'  => password_hash($password, PASSWORD_BCRYPT)
    ]);

    $auth->login([
        'email' => $email
    ]);

    redirect('/');
    }
    $errors['email'] = "This email is already registered before";
        return view("registration/create.view.php", [
            'errors' => $errors
        ]);
}

return view('session/create.view.php', [
    'errors' => $form->errors()
]);

        