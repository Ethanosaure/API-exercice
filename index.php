<?php
require ('controllers/controller.php');

$parts = explode('/' , $_SERVER['REQUEST_URI']);


if ($parts[3] == 'GET'){
    if (isset($parts[4])){
    $id = $parts[4];
    $get = new controller();
    $get->show($id);
} else {
    $getAll = new controller();
    $getAll->showAll();
    }
}
if ($parts[3] == 'POST'){
    $post = new controller();
    $title = 'test';
    $body = 'test'; 
    $author = 'test';
    $post->add($title, $body, $author);
}
if ($parts[3] != 'GET'){
    echo 'PAGE NOT FOUND';
    http_response_code(404);
    exit();
}












?>