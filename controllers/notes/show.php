<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$cuurentUserId = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $note = $db->query('SELECT * FROM notes WHERE id = :id', [
        'id' => $_GET['id'] 
        ])->findOrFaile();
    
    authorize($note['user_id'] == $cuurentUserId);

    $db->query('DELETE FROM notes WHERE id = :id ',[
        'id' => $_GET['id']
    ]);

    header('Location: /notes');
    exit();

}else{

    $note = $db->query('SELECT * FROM notes WHERE id = :id', [
        'id' => $_GET['id'] 
        ])->findOrFaile();
    
    authorize($note['user_id'] == $cuurentUserId);

    view("notes/show.view.php",[
        'heading' => 'My Notes',
        'note' => $note
    ]);
}