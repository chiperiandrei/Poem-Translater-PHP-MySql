<?php
require_once ('libraries/Database.php');

class GetModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAllUsersData(){
        $sQuery = 'select ID, FIRST_NAME, LAST_NAME,EMAIL,USERNAME from users';
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $result = $OUTPUT->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getUserInfoDatabase($id){
        $sQuery = "select ID, FIRST_NAME, LAST_NAME,EMAIL,USERNAME from users where ID=$id";
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $result = $OUTPUT->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getAllPoems(){
        $sQuery = "SELECT p.ID,p.TITLE,p.LANGUAGE,a.NAME FROM poems p  JOIN authors  a ON p.ID_AUTHOR=a.ID";
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $result = $OUTPUT->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getAuthors(){
        $sQuery = "SELECT * FROM authors";
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $result = $OUTPUT->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAuthorInfoDatabase($id)
    {
        $sQuery = "select * from authors where ID=$id";
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $result = $OUTPUT->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPoemInfoDatabase($id)
    {
        $sQuery = "SELECT p.ID,p.TITLE,p.LANGUAGE,a.NAME FROM poems p  JOIN authors  a ON p.ID_AUTHOR=a.ID where p.ID=$id";
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $result = $OUTPUT->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function verificaToken($token)
    {
        $sQuery = "SELECT * from api_tokens where api_key='$token'";
        $OUTPUT = $this->db->prepare($sQuery);
        $OUTPUT->execute();
        $row = $OUTPUT->fetch();
        if ($row) return true;
        else return false;

    }
}