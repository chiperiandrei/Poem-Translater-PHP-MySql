<?php
require_once('libraries/Database.php');

class PutModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function updateAuthorDatabase($data, $id)
    {
        $sql1 = "SELECT * FROM authors WHERE ID =$id";
        $stmt = $this->db->prepare($sql1);
        $stmt->execute();
        $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($data[0]) < 4) {
            $old_name = $result1[0]['NAME'];
            $old_bdate = $result1[0]['BIRTH_DATE'];
            $old_ddate = $result1[0]['DEATH_DATE'];
            $new_name = (array_key_exists("NAME", $data[0])) ? $data[0]['NAME'] : $old_name;

            $new_bdate = (array_key_exists("BIRTH_DATE", $data[0])) ? $data[0]['BIRTH_DATE'] : $old_bdate;
            $new_ddate = (array_key_exists("DEATH_DATE", $data[0])) ? $data[0]['DEATH_DATE'] : $old_ddate;
            $sql2 = "UPDATE authors SET NAME='" . $new_name . "',BIRTH_DATE=$new_bdate,DEATH_DATE=$new_ddate WHERE ID=" . intval($id);
            $stmt2 = $this->db->prepare($sql2);
            if ($stmt2->execute())
                return true;
            else return false;
        } else return false;

    }

    public function updateUserDatabase($data, $id)
    {
        $sql1 = "SELECT FIRST_NAME, LAST_NAME FROM users WHERE ID =$id";
        $stmt = $this->db->prepare($sql1);
        $stmt->execute();
        $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result1[0]);
        if (count($data[0]) < 3) {

            $old_fname = $result1[0]['FIRST_NAME'];
            $old_Lname = $result1[0]['LAST_NAME'];
            $new_fname = (array_key_exists("FIRST_NAME", $data[0])) ? $data[0]['FIRST_NAME'] : $old_fname;

            $new_lname = (array_key_exists("LAST_NAME", $data[0])) ? $data[0]['LAST_NAME'] : $old_Lname;
            $sql2 = "UPDATE users SET FIRST_NAME='" . $new_fname . "',LAST_NAME='" . $new_lname . "' WHERE ID=" . intval($id);
            var_dump($sql2);
            $stmt2 = $this->db->prepare($sql2);
            if ($stmt2->execute())
                return true;
            else return false;
        } else return false;
    }

    public function updatePoemDatabase($data, $id)
    {
        $sql1 = "SELECT * FROM poems WHERE ID =$id";
        $stmt = $this->db->prepare($sql1);
        $stmt->execute();
        $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($data[0])<5){
        $old_title = $result1[0]['TITLE'];
        $old_author = $result1[0]['ID_AUTHOR'];
        $old_language = $result1[0]['LANGUAGE'];
        $old_idstaff = $result1[0]['ID_STAFF'];
        $new_title = (array_key_exists("TITLE", $data[0])) ? $data[0]['TITLE'] : $old_title;

        $new_author = (array_key_exists("ID_AUTHOR", $data[0])) ? $data[0]['ID_AUTHOR'] : $old_author;
        $new_lang = (array_key_exists("LANGUAGE", $data[0])) ? $data[0]['LANGUAGE'] : $old_language;
        $new_staff = (array_key_exists("ID_STAFF", $data[0])) ? $data[0]['ID_STAFF'] : $old_idstaff;
        $sql2 = "UPDATE poems SET TITLE='" . $new_title . "',ID_AUTHOR=$new_author,LANGUAGE='" . $new_lang . "',ID_STAFF=$new_staff WHERE ID=" . intval($id);
        $stmt2 = $this->db->prepare($sql2);
        if ($stmt2->execute())
            return true;
        else return false;}
        else
            return false;
    }


}