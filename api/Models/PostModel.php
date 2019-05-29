<?php
require_once ('libraries/Database.php');

class PostModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function addPoemIntoDb($poem){

    }
}