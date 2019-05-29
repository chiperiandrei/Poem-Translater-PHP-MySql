<?php
require_once('libraries/Database.php');

class PostModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addPoemIntoDb($poem)
    {
        if (count($poem[0]) == 4) {
            $SQL = 'INSERT INTO poems(TITLE,ID_AUTHOR,LANGUAGE,ID_STAFF) VALUES (:titlu,:autor,:lang,:id_staff)';
            $result = $this->db->prepare($SQL);
            $ok = $result->execute([
                ':titlu' => $poem[0]['TITLE'],
                ':autor' => $poem[0]['AUTHOR_ID'],
                ':lang' => $poem[0]['LANGUAGE'],
                ':id_staff' => $poem[0]['STAFF_ID']
            ]);
            if ($ok)
                return true;
            else
                return false;
        } else
            return false;
    }

    public function addAuthorIntoDb($data)
    {
        if (count($data[0]) == 3) {
            $SQL = 'INSERT INTO authors (NAME, BIRTH_DATE, DEATH_DATE) VALUES (:nume, :nastere, :dead);';
            $result = $this->db->prepare($SQL);
            $ok = $result->execute([
                ':nume' => $data[0]['NAME'],
                ':nastere' => $data[0]['BIRTH_DATE'],
                ':dead' => $data[0]['DEATH_DATE']
            ]);
            if ($ok)
                return true;
            else
                return false;
        } else
            return false;
    }
}