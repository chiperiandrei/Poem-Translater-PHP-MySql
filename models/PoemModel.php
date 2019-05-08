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

        if ($statement->rowCount() != 1)
        {
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
}