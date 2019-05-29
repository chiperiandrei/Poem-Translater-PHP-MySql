<?php

require_once("Models/DeleteModel.php");

class DeleteController
{
    public function __construct()
    {

        $this->model = new DeleteModel();
    }

    public function deletePoem($int)
    {
        if ($this->model->deletePoemById($int)) {
            $array['data'] = "Poem deleted succesfully";
            header('Content-Type: application/json');
            echo json_encode($array);
        } else {
            $array['data'] = "That poem doesn't exist ";
            header('Content-Type: application/json');
            echo json_encode($array);
        }
    }

    public function deleteAuthor($int)
    {
        if ($this->model->deleteAuthorById($int)) {
            $array['data'] = "Author deleted succesfully";
            header('Content-Type: application/json');
            echo json_encode($array);
        } else {
            $array['data'] = "That author doesn't exist  ";
            header('Content-Type: application/json');
            echo json_encode($array);
        }
    }

    public function deleteUser($int)
    {
        if ($this->model->deleteUserById($int)) {
            $array['data'] = "User deleted succesfully";
            header('Content-Type: application/json');
            echo json_encode($array);
        } else {
            $array['data'] = "That user doesn't exist  ";
            header('Content-Type: application/json');
            echo json_encode($array);
        }
    }

}