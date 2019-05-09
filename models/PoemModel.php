<?php

require_once('libraries/Model.php');

class PoemModel extends Model
{
    private $poem_id;

    public function __construct()
    {
        parent::__construct();
    }

    public function loadPoemHeader($poem_title, $poem_language)
    {
        $SQL = 'SELECT p.ID AS POEM_ID, p.TITLE as POEM_TITLE, p.LANGUAGE, p.ID_AUTHOR AS AUTHOR_ID, 
                       a.NAME AS AUTHOR_NAME, a.BIRTH_DATE AS AUTHOR_BIRTH, a.DEATH_DATE AS AUTHOR_DEATH
                FROM poems p 
                JOIN authors a ON p.ID_AUTHOR = a.ID
                WHERE p.TITLE = "' . $poem_title . '" AND p.LANGUAGE = "' . $poem_language . '"';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetch();

        if ($statement->rowCount() != 1) {
            return;
        }

        $this->poem_id = $result['POEM_ID'];

        return $result;
    }

    public function loadPoemBody()
    {
        if ($this->poem_id) {
            $SQL = 'SELECT TEXT FROM strophes 
                    WHERE ID_POEM = ' .  $this->poem_id . ' ORDER BY NTH ASC';

            $statement = $this->db->prepare($SQL);

            $statement->execute();

            $result = $statement->fetchAll();

            return $result;
        }

        return;
    }

    public function loadAvailableTranslations()
    {
        if ($this->poem_id) {
            $SQL = 'SELECT DISTINCT LANGUAGE FROM translations WHERE ID_POEM = ' . $this->poem_id;

            $statement = $this->db->prepare($SQL);

            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
        return;
    }

    public function loadTranslations($poem_title, $poem_language)
    {
        $SQL = 'SELECT u.ID AS USER_ID, u.FIRST_NAME AS USER_FN, u.LAST_NAME AS USER_LN, u.USERNAME, u.EMAIL AS USER_EMAIL,
                       t.id AS TRANSLATION_ID, t.RATING AS TRANSLATION_RATING
                FROM poems p
                JOIN authors a ON p.ID_AUTHOR = a.ID
                JOIN translations t ON p.ID = t.ID_POEM
                JOIN users u ON t.ID_USER = u.ID
                WHERE p.TITLE = "' . $poem_title . '" AND t.LANGUAGE = "' . $poem_language . '";';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        if ($statement->rowCount() < 1) {
            return;
        }

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function loadInfos($poem_title) {
        $SQL = 'SELECT a.NAME, LOWER(p.LANGUAGE) AS LANGUAGE, p.ID AS POEM_ID FROM authors a 
                JOIN poems p ON p.ID_AUTHOR = a.ID
                WHERE LOWER(P.TITLE) = LOWER("' . $poem_title . '");';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        if ($statement->rowCount() != 1) {
            return;
        }

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $this->poem_id = $result['POEM_ID'];

        return $result;
    }
}