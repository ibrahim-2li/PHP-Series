<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php');
$router->delete('/note', 'notes/destroy.php');
$router->get('/notes/create', 'notes/create.php');
$router->get('/note/edit', 'notes/edit.php');
$router->patch('/note', 'notes/update.php');
$router->post('/notes/create', 'notes/store.php');

$router->get('/registration', 'registration/create.php')->only('guest');
$router->post('/registration', 'registration/store.php');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');

$router->delete('/logout', 'session/destroy.php')->only('auth');

