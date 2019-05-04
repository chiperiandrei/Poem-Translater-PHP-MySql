<?php

require_once('libraries/Model.php');

class AuthorModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function showAllPoems($author)
    {
        $author = str_replace('-', ' ', $author);
        $SQL = 'SELECT p.title as TITLU_POEM FROM poems p join authors a on p.ID_AUTHOR = a.ID where a.NAME=' . $author;
        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetch();

        return $result;

    }

    public function loadAuthorInfo($author)
    {
        $SQL = 'SELECT NAME AS NUME,BIRTH_DATE AS DATA_NASTERE, DEATH_DATE as DATA_DECEDARE FROM authors WHERE NAME=' . $author;

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetch();

        return $result;
    }

}