<?php

$config = require('config.php');
$db = new Database($config['database']);

$heading = 'My Notes';
$cuurentUserId = 1;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id'] 
    ])->findOrFaile();

authorize($note['user_id'] == $cuurentUserId);


require "views/note.view.php";