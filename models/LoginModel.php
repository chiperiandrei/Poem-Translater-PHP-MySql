<?php

require_once('libraries/Model.php');

class LoginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function verifyUser()
    {
        $SQL = 'SELECT id, first_name, last_name, email, username FROM users WHERE email = :email AND password = :password';

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
            Session::set('username', $row['username']);

            return true;
        }

        return false;
    }

    public function verifyUserReg($email, $username)
    {
        $SQL = 'SELECT * FROM users WHERE email = ' . $email . 'or username = ' . $username;

        $result = $this->db->prepare($SQL);
        if ($result->rowCount() === 0)
            return true;
        else
            return false;
    }

    public function register()
    {
        $SQL = 'INSERT INTO users(first_name,last_name,email,username,password) VALUES (:fname,:lname,:email,:username,:password)';

        $result = $this->db->prepare($SQL);
        $ok = $result->execute([
            ':fname' => $_POST['first-name'],
            ':lname' => $_POST['last-name'],
            ':email' => $_POST['email'],
            ':username' => $_POST['username'],
            ':password' => md5($_POST['password'])
        ]);
        if ($ok) {
            if (!file_exists('storage/'.$_POST['username'])) {
                mkdir('storage/'.$_POST['username'], 0777, true);
            }
        }
        return $ok;

    }

    public function loadPoemHeader($poem_id)
    {
        $SQL = 'SELECT p.ID AS POEM_ID, p.ID_AUTHOR AS AUTHOR_ID, p.TITLE AS POEM_TITLE, a.NAME AS AUTHOR_NAME, 
                LOWER(p.LANGUAGE) AS LANGUAGE FROM poems p
                JOIN authors a ON p.ID_AUTHOR = a.ID WHERE p.ID = ' . $poem_id;

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetch();

        return $result;
    }

    public function loadPoemBody($poem_id)
    {
        $poem = $this->loadPoemHeader($poem_id);

        $SQL = 'SELECT TEXT AS POEM_CONTENT FROM strophes WHERE NTH = 1 AND ID_POEM = ' . $poem['POEM_ID'];

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        $result = $statement->fetch();

        return $result;
    }
}