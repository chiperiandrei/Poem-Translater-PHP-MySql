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
        $result = $this->db->prepare('SELECT id, first_name, last_name, email FROM users WHERE email = :email AND password = :password');

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
}