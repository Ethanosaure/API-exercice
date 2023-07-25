<?php
require ('controllers/controller.php');

$parts = explode('/' , $_SERVER['REQUEST_URI']);

var_dump($parts);

if ($parts[3] != 'controllers'){
    http_response_code(404);
    exit();
}

$id = $part[4] ?? null;

var_dump($id);



?>