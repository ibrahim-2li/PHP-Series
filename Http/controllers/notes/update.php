<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

    $note = $db->query('select * from notes where id = :id', [
        'id' => $_POST['id']
    ])->findOrFail();
    
    authorize($note['user_id'] == $currentUserId);

    $errors= [];


    if (! Validator::string($_POST['body'], 1, 1500)) {
        $errors['body'] = 'A body of no more than 1,000 characters is required.';
    }

    if(count($errors)){
        return view('notes/edit.view.php',[
            'heading' => 'Edit Notes',
            'errors' => $errors,
            'note' => $note
        ]);
    }

    $db->query("update notes set body = :body where id = :id",[
        'body' => $_POST['body'],
        'id' => $_POST['id']
    ]);

    header('location: /notes');
    exit();
