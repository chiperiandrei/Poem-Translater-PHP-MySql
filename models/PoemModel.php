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
                WHERE p.TITLE = "' . $poem_title . '" AND t.LANGUAGE = "' . $poem_language . '"
                ORDER BY t.RATING DESC;';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        if ($statement->rowCount() < 1) {
            // return;
            return null;
        }

        $this->poem_title = $poem_title;
        $this->poem_language = $poem_language;

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

    public function loadPoemForTranslationHeader($poem_title) {
        $SQL = 'SELECT p.ID AS POEM_ID, p.TITLE as POEM_TITLE, p.LANGUAGE AS LANGUAGE, p.ID_AUTHOR AS AUTHOR_ID, 
                       a.NAME AS AUTHOR_NAME
                FROM poems p 
                JOIN authors a ON p.ID_AUTHOR = a.ID
                WHERE p.TITLE = "' . $poem_title . '"';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($statement->rowCount() != 1) {
            return;
        }

        $this->poem_id = $result['POEM_ID'];

        return $result;
    }

    public function loadLanguages() {
        $SQL = "SHOW COLUMNS FROM poems LIKE 'LANGUAGE'";
        $statement = $this->db->prepare($SQL);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function loadUserTranslation($poem_id, $user_id) {
        $SQL = 'SELECT LANGUAGE FROM translations WHERE ID_POEM = ' . $poem_id . ' AND ID_USER = ' . $user_id;
        $statement = $this->db->prepare($SQL);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return null;
        }
        return $result;
    }

    public function addTransition($poem_data, $user_id) {
        $SQL = 'INSERT INTO translations (ID_POEM, ID_USER, RATING, LANGUAGE) ' .
               'VALUES ("' . $poem_data['id'] . '", "' . $user_id . '", "0", "' . $poem_data['translation']['language'] . '")';

        $statement = $this->db->prepare($SQL);
        $statement->execute();

        $SQL = 'SELECT ID FROM translations WHERE ID_POEM = ' . $poem_data['id'] . ' AND ID_USER = ' . $user_id . ' AND ' .
               'LANGUAGE = "' . $poem_data['translation']['language'] . '"';

        $statement = $this->db->prepare($SQL);
        $statement->execute();
        $translation_id = $statement->fetch(PDO::FETCH_ASSOC);
        $translation_id = $translation_id['ID'];
        $nth = 1;

        foreach ($poem_data['translation']['strophes'] as $strophe) {
            if (!empty($strophe)) {
                $SQL = 'INSERT INTO translation_strophes (ID_TRANSLATION, NTH, TEXT) ' .
                    'VALUES (' . $translation_id . ', ' . $nth . ', "' . $strophe . '")';
                $statement = $this->db->prepare($SQL);
                $statement->execute();
            }
            $nth++;
        }
    }

    /**
     * use countPoemStrophes() always after loadTranslationHeader($poem_title)
     */
    public function countPoemStrophes() {
        $SQL = 'SELECT COUNT(*) AS COUNT FROM strophes 
                WHERE ID_POEM = ' .  $this->poem_id;

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($statement->rowCount() != 1) {
            return;
        }

        return $result['COUNT'];
    }

    public function selectUser($username) {
        $SQL = 'SELECT u.ID AS USER_ID, u.FIRST_NAME AS USER_FN, u.LAST_NAME AS USER_LN,
                ui.PATH as USER_AVATAR
                FROM users u
                LEFT JOIN user_images ui ON u.ID = ui.ID_USER
                WHERE u.USERNAME = "' . $username . '"';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($statement->rowCount() != 1) {
            return;
        }

        return $result;
    }

    public function loadTranslationHeader($poem_id, $user_id, $translation_language) {
        $SQL = 'SELECT ID AS TRANSLATION_ID, RATING
                FROM translations
                WHERE ID_POEM = ' . $poem_id . ' AND ID_USER = ' . $user_id . ' AND
                LANGUAGE = "' . $translation_language . '"';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($statement->rowCount() != 1) {
            return;
        }

        return $result;
    }

    public function loadTranslationBody($translation_id) {
        $SQL = 'SELECT NTH, TEXT FROM translation_strophes
                WHERE ID_TRANSLATION = ' . $translation_id . '
                ORDER BY NTH ASC';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($statement->rowCount() < 1) {
            return;
        }

        return $result;
    }

    public function loadComments($poem_id) {
        $SQL = 'SELECT c.ID, c.TEXT, u.FIRST_NAME, u.LAST_NAME, u.EMAIL, u.USERNAME, ui.PATH FROM comments c
                JOIN users u ON c.ID_USER = u.ID
                LEFT JOIN user_images ui ON c.ID_USER = ui.ID_USER
                WHERE c.ID_POEM = ' . $poem_id . '
                ORDER BY c.ID DESC';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($statement->rowCount() < 1) {
            return;
        }

        return $result;
    }

    public function insertComment($poem_id, $user_id, $text) {
        $SQL = 'INSERT INTO comments (ID_POEM, ID_USER, TEXT) 
                VALUES ("' . $poem_id . '","' . $user_id . '","' . $text . '")';

        $statement = $this->db->prepare($SQL);

        $statement->execute();
    }

    public function removeComment($poem_id, $user_id, $comment_id) {
        $SQL = 'DELETE FROM comments WHERE comments.ID = ' . $comment_id .
               ' AND comments.ID_POEM = ' . $poem_id .
               ' AND comments.ID_USER = ' . $user_id;

        $statement = $this->db->prepare($SQL);

        $statement->execute();
    }

    public function removeTranslation($translation_id) {
        $SQL = 'DELETE FROM translation_strophes WHERE ID_TRANSLATION = ' . $translation_id;

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $SQL = 'DELETE FROM translations WHERE ID = ' . $translation_id;

        $statement = $this->db->prepare($SQL);

        $statement->execute();
    }
}