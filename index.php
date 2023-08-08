<?php
require "controllers/controller.php";
$base = "/API/API-exercice";

$request_uri = $_SERVER["REQUEST_URI"];

$parts = str_replace($base, "", $request_uri);

$id = $_GET["id"] ?? null;

$method = $_SERVER["REQUEST_METHOD"];

switch ($parts) {
    case "/GET?id=" . $id . "":
        if ($method === "GET") {
            $response = new controller();
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $response->show($id);
        }
        break;
    case "/GET":
        if ($method === "GET") {
            $response = new controller();
            $response->showAll();
            http_response_code(200);
        }
        break;
    case "/POST":
        if ($method === "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data["title"]) && isset($data["body"]) && isset($data["author"])) {
                $title = $data["title"];
                $body = $data["body"];
                $author = $data["author"];
                $title = filter_var($title, FILTER_SANITIZE_STRING);
                $body = filter_var($body, FILTER_SANITIZE_STRING);
                $author = filter_var($author, FILTER_SANITIZE_STRING);
                $pattern = '/^[A-Za-z0-9\s.,!?\'"-]+$/';
                 if (
                !preg_match($pattern, $title) ||
                !preg_match($pattern, $body) ||
                !preg_match($pattern, $author)
                ){
                    echo 'please remove all special characters from your informations';
                    http_response_code(400);
                } else {
                $response = new controller();
                $response->add($title, $body, $author);
                http_response_code(201);
                echo "element added";
            }
        }
                else {
                echo "error, cannot add element, check if all the post are fill";
                http_response_code(400);
            }
        }
        break;

    case "/PUT?id=" . $id . "":
        if ($method === "PUT") {
            $data = json_decode(file_get_contents("php://input"), true);
            if (
                !isset($data["title"]) &&
                !isset($data["body"]) &&
                !isset($data["author"])
            ) {
                echo "cannot update : no correct informations provided";
                http_response_code(400);
                return;
            } else {
                $title = filter_var($data["title"], FILTER_SANITIZE_STRING) ?? "";
                $body = filter_var($data["body"], FILTER_SANITIZE_STRING) ?? "";
                $author = filter_var($data["author"], FILTER_SANITIZE_STRING) ?? "";
                $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                $pattern = '/^[A-Za-z0-9\s.,!?\'"-]+$/';

            if (
                !preg_match($pattern, $title) ||
                !preg_match($pattern, $body) ||
                !preg_match($pattern, $author)
            ){
                echo "remove all special characters from your informations";
                http_response_code(400);
            } else {
                $response = new controller();
                $response->charliePuth($title, $author, $body, $id);
                http_response_code(200);
            }
        }
    }
        break;

    case "/DELETE?id=" . $id . "":
        if ($method === "DELETE") {
            $response = new controller();
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $response->delete($id);
            http_response_code(200);
        }
    default:
        http_response_code(400);
        break;
}
?>