<?php


require_once('libraries/Model.php');

class UserModel extends Model
{
    public $id;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectAllUserInfo($username)
    {
        $SQL = 'SELECT ID,FIRST_NAME, LAST_NAME, USERNAME FROM USERS WHERE USERNAME="' . $username . '"';
        $statement = $this->db->prepare($SQL);
        $statement->execute();
        $result = $statement->fetch();
        $this->id = $result['ID'];
        return $result;
    }

    public function getAvatar()
    {
        $SQL = 'SELECT PATH FROM user_images JOIN users ON ID_USER =' . $this->id;

        $result = $this->db->query($SQL);

        if ($result) {
            $result = $result->fetch();
            return $result['PATH'];
        }

        return;
    }

    public function verifyUsername($username)
    {
        $SQL = 'SELECT * FROM USERS WHERE USERNAME="' . $username . '"';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        return $statement->rowCount() == 0 ? false : true;
    }

    public function loadPoems()
    {
        $SQL = 'SELECT p.TITLE, t.LANGUAGE FROM translations t 
                JOIN poems p ON p.ID = t.ID_POEM
                WHERE t.ID_USER = ' . $this->id;

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        if ($statement->rowCount() == 0) {
            return null;
        }

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}