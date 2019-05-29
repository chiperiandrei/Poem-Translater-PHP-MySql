<?php

require_once("Models/GetModel.php");

class GetController
{
    public function __construct()
    {

        $this->model = new GetModel();
    }

    public function getAllUsers()
    {
        $response = $this->model->getAllUsersData();
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getUserInfo($id)
    {
        $response = $this->model->getUserInfoDatabase($id);
        if (empty($response)) {
            $array['data'] = "This user doesn't not exists";
            header('Content-Type: application/json');
            echo json_encode($array);
        } else {
            header('Content-Type: application/json');
            echo json_encode($response);
        }

    }

    public function getPoems()
    {
        $response = $this->model->getAllPoems();
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getAuthors()
    {
        $response = $this->model->getAuthors();
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getPoemsById($id)
    {
        $response = $this->model->getPoemInfoDatabase($id);
        if (empty($response)) {
            $array['data'] = "This poem doesn't not exists";
            header('Content-Type: application/json');
            echo json_encode($array);
        } else {
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function getAuthorsById($id)
    {
        $response = $this->model->getAuthorInfoDatabase($id);
        if (empty($response)) {
            $array['data'] = "This author doesn't not exists";
            header('Content-Type: application/json');
            echo json_encode($array);
        } else {
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}