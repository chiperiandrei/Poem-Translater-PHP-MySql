<?php

require_once('libraries/Model.php');

class LoginModel extends Model
{
    public function __construct()
    {
        parent::__construct();

        // echo 'models/LoginModel.php<br>';
    }

    public function connect()
    {
        $SQL = 'SELECT id, first_name, last_name, email FROM users WHERE email = :email AND password = :password';

        $result = $this->db->prepare($SQL);

        $result->execute([
            ':email' => $_POST['email'],
            ':password' => $_POST['password']
        ]);

        if ($result->rowCount() === 1) {

            $row = $result->fetch(PDO::FETCH_ASSOC);

            Session::set('user_id', $row['id']);
            Session::set('first_name', $row['first_name']);
            Session::set('last_name', $row['last_name']);
            Session::set('email', $row['email']);

            return true;
        }

        return false;
    }

    public function loadPoemHeader()
    {
        $SQL = 'SELECT p.ID AS POEM_ID, p.ID_AUTHOR AS AUTHOR_ID, p.TITLE AS POEM_TITLE, a.NAME AS AUTHOR_NAME, 
                LOWER(p.LANGUAGE) AS LANGUAGE
                FROM poems p
                JOIN authors a ON p.ID_AUTHOR = a.ID;';

        $result = [];

        foreach ($this->db->query($SQL) as $row) {
            array_push($result, $row);
        }

        return $result;
    }

    public function loadPoemContent()
    {
        $poemHeader = $this->loadPoemHeader();

        $result = [];

        foreach ($poemHeader as $poem)
        {
            $SQL = 'SELECT TEXT AS POEM_CONTENT FROM strophes WHERE NTH = 1 AND ID_POEM = ' . $poem['POEM_ID'];
            $row = $this->db->query($SQL)->fetch();
            array_push( $result, $row);
        }

        return $result;
    }
}