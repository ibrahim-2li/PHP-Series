<?php

$config = require base_path('config.php');
$db = new Database($config['database']);

$cuurentUserId = 1;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id'] 
    ])->findOrFaile();

authorize($note['user_id'] == $cuurentUserId);


view("notes/show.view.php",[
    'heading' => 'My Notes',
    'note' => $note
]);