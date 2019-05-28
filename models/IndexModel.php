<?php

require_once('libraries/Model.php');

class IndexModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function loadAvatar()
    {
        $SQL = 'SELECT PATH FROM user_images WHERE ID_USER = ' . Session::get('user_id');

        $statement = $this->db->prepare($SQL);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['PATH'];
        }

        return null;
    }

    public function loadPoemsHeader()
    {
        $SQL = 'SELECT p.ID AS POEM_ID, p.ID_AUTHOR AS AUTHOR_ID, p.TITLE AS POEM_TITLE, a.NAME AS AUTHOR_NAME, 
                LOWER(p.LANGUAGE) AS LANGUAGE
                FROM poems p
                JOIN authors a ON p.ID_AUTHOR = a.ID';

        $result = [];

        foreach ($this->db->query($SQL) as $row) {
            array_push($result, $row);
        }

        return $result;
    }

    public function loadPoemsBody()
    {
        $poems = $this->loadPoemsHeader();

        $result = [];

        foreach ($poems as $poem)
        {
            $SQL = 'SELECT TEXT AS POEM_CONTENT FROM strophes WHERE NTH = 1 AND ID_POEM = ' . $poem['POEM_ID'];
            $row = $this->db->query($SQL)->fetch();
            array_push( $result, $row['POEM_CONTENT']);
        }

        return $result;
    }

    public function loadAuthors() {
        $SQL = 'SELECT * FROM authors ORDER BY NAME';

        $statement = $this->db->prepare($SQL);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function loadLanguages() {
        $SQL = "SHOW COLUMNS FROM poems LIKE 'LANGUAGE'";
        $statement = $this->db->prepare($SQL);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function insertPoem($title, $author_id, $language, $staff_id, $strophes) {
        $SQL = 'INSERT INTO poems (TITLE, ID_AUTHOR, LANGUAGE, ID_STAFF) ' .
               'VALUES ("'. $title .'", '. $author_id .', "'. $language .'", '. $staff_id .')';

        $statement = $this->db->prepare($SQL);
        $statement->execute();

        $SQL = 'SELECT ID FROM poems WHERE TITLE = "'. $title .'" AND ID_AUTHOR = '. $author_id .' '.
               'AND LANGUAGE = "'. $language .'" AND ID_STAFF = '. $staff_id;

        $statement = $this->db->prepare($SQL);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $poem_id = $result['ID'];
        $nth = 1;

        foreach ($strophes as $strophe) {
            $SQL = 'INSERT INTO strophes (ID_POEM, NTH, TEXT) ' .
                   'VALUES ('. $poem_id .', '. $nth .', "'. $strophe .'")';

            $statement = $this->db->prepare($SQL);
            $statement->execute();
            $nth++;
        }
    }

    public function loadPoemAndAuthor() {
        $SQL = 'SELECT p.ID AS POEM_ID, p.TITLE AS POEM_TITLE, a.NAME AS AUTHOR_NAME, 
                LOWER(p.LANGUAGE) AS LANGUAGE
                FROM poems p
                JOIN authors a ON p.ID_AUTHOR = a.ID
                ORDER BY LANGUAGE, POEM_TITLE';

        $result = [];

        foreach ($this->db->query($SQL) as $row) {
            array_push($result, $row);
        }

        return $result;
    }

    public function deletePoem($poem_id) {
        $SQL = 'DELETE FROM strophes WHERE ID_POEM = ' . $poem_id;

        $statement = $this->db->prepare($SQL);
        $statement->execute();

        $SQL = 'DELETE FROM poems WHERE ID = ' . $poem_id;

        $statement = $this->db->prepare($SQL);
        $statement->execute();
    }

    public function insertAuthor($author, $b_date, $d_date) {
        $SQL = 'INSERT INTO authors (NAME, BIRTH_DATE, DEATH_DATE) ' .
               'VALUES ("'. $author .'", '. $b_date .', '. $d_date .')';
        $statement = $this->db->prepare($SQL);
        $statement->execute();
    }

    public function deleteAuthor($author_id) {
        $SQL = 'DELETE FROM authors WHERE ID = ' . $author_id;

        $statement = $this->db->prepare($SQL);
        $statement->execute();

        $SQL = 'DELETE FROM author_images WHERE ID_AUTHOR = ' . $author_id;

        $statement = $this->db->prepare($SQL);
        $statement->execute();
    }

    public function insertFavorites($user_id, $poem_id) {
        $SQL = 'INSERT INTO favorites (ID_USER, ID_POEM) ' .
               'VALUES ('. $user_id .', '. $poem_id .')';
        $statement = $this->db->prepare($SQL);
        $statement->execute();
    }

    public function loadFavorites($user_id) {
        $SQL = 'SELECT ID_POEM FROM favorites WHERE ID_USER = ' . $user_id;
        $statement = $this->db->prepare($SQL);
        $statement->execute();

        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        $i = 0;

        foreach ($array as $row) {
            $result[$i++] = $row['ID_POEM'];
        }

        return $result;
    }

    public function deleteFavorites($user_id, $poem_id) {
        $SQL = 'DELETE FROM favorites WHERE ID_USER = '. $user_id .' AND ID_POEM = '. $poem_id;

        $statement = $this->db->prepare($SQL);
        $statement->execute();
    }
}