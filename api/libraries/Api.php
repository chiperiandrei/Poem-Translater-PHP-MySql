<?php

require_once("libraries/Database.php");
require_once("Controllers/GetController.php");
require_once("Controllers/PostController.php");

class Api
{
    private $controller;

    public function __construct()
    {
        if (isset($_GET['URL'])) {
            $URLs = explode('/', $_GET['URL']);
        } else {
            $URLs[0] = 'index';
        }
        $request_method = $_SERVER["REQUEST_METHOD"];
        switch ($request_method) {
            case 'GET':
                $this->controller = new GetController();
                if ($URLs[0] == 'users') {
                    if (count($URLs) == 1) {
                        $this->controller->getAllUsers();
                        break;
                    } else if (count($URLs) == 2) {
                        $this->controller->getUserInfo($URLs[1]);
                        break;
                    }
                }

                if ($URLs[0] == 'poems') {
                    if (count($URLs) == 1) {
                        $this->controller->getPoems();
                        break;
                    } else if (count($URLs) == 2) {
                        $this->controller->getPoemsById($URLs[1]);
                        break;
                    }
                }
                if ($URLs[0] == 'authors') {
                    if (count($URLs) == 1) {
                        $this->controller->getAuthors();
                        break;
                    } else if (count($URLs) == 2) {
                        $this->controller->getAuthorsById($URLs[1]);
                        break;
                    }
                }
            case 'POST':
                $this->controller = new PostController();
                $data = json_decode(file_get_contents('php://input'), true);
                var_dump($data);
                if ($URLs[0]=='poems'){
                    $this->controller->addPoem($data);
                }
            default:
                // Invalid Request Method
                header("HTTP/1.0 405 Method Not Allowed");
                break;
        }
    }
}