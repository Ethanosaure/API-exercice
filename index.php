<?php
require ('controllers/controller.php');
$base = '/API/API-exercice';

$request_uri = $_SERVER['REQUEST_URI'];

$parts = str_replace($base, '' , $request_uri);

$id = $_GET['id'] ?? null;

$method = $_SERVER['REQUEST_METHOD'];

switch ($parts){
    case '/GET?id='.$id.'':
       if ($method === 'GET'){
                $response = new controller ();
                $response->show($id);  
        }
        break;
    case '/GET':
        if ($method === 'GET'){
            $response = new controller();
            $response->showAll();
            http_response_code(200);
        }
        break;

    case '/POST':
        if ($method === 'POST'){
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data['title'] && $data['body'] && $data['author']){
        $title = $data['title'];
        $body = $data['body'];
        $author = $data['author'];
        $response = new controller();
        $response->add($title, $body, $author);
        http_response_code(201);
        echo 'element added';

        } else {
            echo 'error, cannot add element';
            http_response_code(400);
        }
    }
        break;

        case '/PUT?id='.$id.'':
            if ($method === 'PUT'){
                $data = json_decode(file_get_contents('php://input'), true);
                if (!$data['title'] && !$data['body'] && !$data['author']){
                echo 'cannot update';
                http_response_code(400);
                }
                else {
                $title = $data['title'] ? $data['title'] : 0; 
                $body = $data['body'] ?  $data['body'] :  0;
                $author = $data['author'] ? $data['author'] : 0;
                $response = new controller();
                $response->charliePuth($title, $author, $body, $id);
                http_response_code(200); 
                }
            }
            break;
        
        case '/DELETE?id='.$id.'':
            if ($method === 'DELETE'){
                $response = new controller();
                $response->delete($id);
                http_response_code(200);
            }
    default:
       http_response_code(400);
        break;

}




















// if ($parts[3]){
// if ($parts[3] == 'GET'){
//     if (isset($parts[4])){
//     $id = $parts[4];
//     $get = new controller();
//     $get->show($id);
// } else {
//     $getAll = new controller();
//     $getAll->showAll();
//     }
// }
// if ($parts[3] == 'POST'){
//     $post = new controller();
//     $title = 'test';
//     $body = 'test'; 
//     $author = 'test';
//     $post->add($title, $body, $author);
//     echo 'element successfully add to db';
// }
// if ($parts[3] != 'GET' && $parts[3] != 'POST'){
//     echo 'PAGE NOT FOUND';
//     http_response_code(404);
//     exit();
// }
// }













?>