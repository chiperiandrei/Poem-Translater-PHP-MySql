<?php

require_once("libraries/Database.php");
require_once("Controllers/GetController.php");
require_once("Controllers/PostController.php");
require_once("Controllers/DeleteController.php");
require_once("Controllers/PutController.php");

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
                $headers = apache_request_headers();
                if ($this->controller->verifyToken($headers['authkey'])) {
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
                }
                else{
                    header("HTTP/1.0 405 YOU HAVE NO POWER HERE");
                    $array['eroare'] = "YOU HAVE NO POWER HERE BOSSSSSSSSSSSSSS";
                    header('Content-Type: application/json');
                    echo json_encode($array);
                    break;
                }

            case 'POST':
                $this->controller = new PostController();
                $data = json_decode(file_get_contents('php://input'), true);
                if ($URLs[0] == 'poems') {
                    $this->controller->addPoem($data);
                }
                if ($URLs[0] == 'authors') {
                    $this->controller->addAuthor($data);
                }
            case 'DELETE':
                $this->controller = new DeleteController();
                if ($URLs[0] == 'poems') {
                    if (count($URLs) == 2) {
                        $this->controller->deletePoem($URLs[1]);
                    }
                }
                if ($URLs[0] == 'authors') {
                    if (count($URLs) == 2) {
                        $this->controller->deleteAuthor($URLs[1]);
                    }
                }
                if ($URLs[0] == 'users') {
                    if (count($URLs) == 2) {
                        $this->controller->deleteUser($URLs[1]);
                    }
                }
            case 'PUT':
                $this->controller = new PutController();
                $data = json_decode(file_get_contents('php://input'), true);
                if (count($URLs) == 2) {
                    if ($URLs[0] == 'authors') {
                        $this->controller->updateAuthor($data,$URLs[1]);
                    }
                    if ($URLs[0] == 'poems') {
                        $this->controller->updatePoem($data,$URLs[1]);
                    }
                    if ($URLs[0] == 'users') {
                        $this->controller->updateUser($data,$URLs[1]);
                    }
                }
            default:
                // Invalid Request Method
                header("HTTP/1.0 405 Method Not Allowed");
                break;
        }
    }
}