<?php


require_once('libraries/Model.php');

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function loadUserData($username)
    {
        $SQL = 'SELECT ID, EMAIL, FIRST_NAME, LAST_NAME, USERNAME FROM users WHERE USERNAME = "' . $username . '"';
        $statement = $this->db->prepare($SQL);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        }
        return null;
    }

    public function loadAvatar($user_id)
    {
        $SQL = 'SELECT PATH FROM user_images JOIN users ON ID_USER = ' . $user_id;

        $result = $this->db->query($SQL);

        if ($result) {
            $result = $result->fetch();
            return $result['PATH'];
        }

        return null;
    }

    public function loadUserTranslations($user_id)
    {
        $SQL = 'SELECT p.TITLE, t.LANGUAGE FROM translations t 
                JOIN poems p ON p.ID = t.ID_POEM
                WHERE t.ID_USER = ' . $user_id . '
                ORDER BY t.LANGUAGE, p.TITLE';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        if ($statement->rowCount() == 0) {
            return null;
        }

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}