<?php

require_once("Models/PutModel.php");

class PutController
{
    public function __construct()
    {

        $this->model = new PutModel();
    }

    public function updateAuthor($data,$id)
    {
        if ($this->model->updateAuthorDatabase($data,$id)) {
            $array['data'] = "Author updated succesfully";
            header('Content-Type: application/json');
            echo json_encode($array);
        } else {
            $array['data'] = "Error during update the author ";
            header('Content-Type: application/json');
            echo json_encode($array);
        }
    }

    public function updatePoem($data,$id)
    {
        if ($this->model->updatePoemDatabase($data,$id)) {
            $array['data'] = "Poem updated succesfully";
            header('Content-Type: application/json');
            echo json_encode($array);
        } else {
            $array['data'] = "Error during update the poem ";
            header('Content-Type: application/json');
            echo json_encode($array);
        }
    }

    public function updateUser($data,$id)
    {
        if ($this->model->updateUserDatabase($data,$id)) {
            $array['data'] = "User updated succesfully";
            header('Content-Type: application/json');
            echo json_encode($array);
        } else {
            $array['data'] = "Error during updating user account ";
            header('Content-Type: application/json');
            echo json_encode($array);
        }
    }

}