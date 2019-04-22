<?php

require_once('libraries/Database.php');

class Model
{
    protected $db;

    function __construct()
    {
        // echo 'libraries/Model.php<br>';

        $this->db = new Database();
    }

}