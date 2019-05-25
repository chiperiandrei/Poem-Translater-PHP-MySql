<?php

require_once('libraries/Model.php');

class AuthorModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function loadAuthorData($author_name)
    {
        $SQL = 'SELECT ID, NAME, BIRTH_DATE, DEATH_DATE FROM authors WHERE NAME = "' . $author_name . '"';
        $statement = $this->db->prepare($SQL);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result == false) {
            return null;
        }
        return $result;
    }

    public function loadAuthorPhoto($author_id){
        $SQL = 'SELECT PATH FROM author_images WHERE ID_AUTHOR = ' . $author_id;
        $statement = $this->db->prepare($SQL);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result == false) {
            return null;
        }
        return $result['PATH'];
    }

    public function loadPoems($author_id) {
        $SQL = 'SELECT ID, TITLE, LANGUAGE FROM poems WHERE ID_AUTHOR = ' . $author_id;
        $statement = $this->db->prepare($SQL);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($result == false) {
            return null;
        }
        return $result;

    }

}