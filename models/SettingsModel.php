<?php

require_once('libraries/Model.php');

class SettingsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function updateInfo($new_firstname, $new_lastname, $new_email, $new_password, $new_username)
    {
        $current_user = Session::get('username');

        $SQL = 'UPDATE users SET FIRST_NAME="'.$new_firstname.'",LAST_NAME="'.$new_lastname.'",EMAIL="'.$new_email.'",USERNAME="'.$new_username.'",PASSWORD="'.md5($new_password).'" WHERE username="'. $current_user.'"';

        $count=$this->db->exec($SQL);

        if ($count==1) {

            Session::set('username',$new_username);
            Session::set('first_name', $new_firstname);
            Session::set('last_name', $new_lastname);
            Session::set('email', $new_email);
            rename('storage/users/'.$current_user,'storage/users/'.$new_username);
            return true;
        }
        else return false;

    }

    public function verifyUsername($username)
    {
        $SQL = 'SELECT * FROM USERS WHERE USERNAME="' . $username . '"';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        if ($statement->rowCount() == 0)
            return true;
        else {
            Session::set('update-info-username-already-exists', 'este usernameeul');
            return false;
        }

    }

    public function verifyEmail($email)
    {
        $SQL = 'SELECT * FROM USERS WHERE EMAIL="' . $email . '"';

        $statement = $this->db->prepare($SQL);

        $statement->execute();

        if ($statement->rowCount() == 0)
            return true;
        else {
            Session::set('update-info-email-already-exists', 'este emailuiilul');
            return false;
        }

    }

}