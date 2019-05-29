<?php
require_once('libraries/Database.php');

class DeleteModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function deletePoemById($int)
    {
        $query = "DELETE FROM poems WHERE id=$int";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        return $count == 1 ? true : false;
    }

    public function deleteAuthorById($int)
    {
        $query = "DELETE FROM authors WHERE id=$int";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        return $count == 1 ? true : false;
    }

    public function deleteUserById($int)
    {
        $query = "DELETE FROM users WHERE id=$int";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        return $count == 1 ? true : false;
    }


}