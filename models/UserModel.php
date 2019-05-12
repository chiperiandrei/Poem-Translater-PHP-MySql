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

}